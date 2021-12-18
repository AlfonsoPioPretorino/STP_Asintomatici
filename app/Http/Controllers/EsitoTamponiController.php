<?php

namespace App\Http\Controllers;

use App\Models\Utenti;
use App\Models\User;
use App\Models\laboratori;
use App\Models\coord;
use App\Models\prenotazioni;
use App\Models\medici;
use App\Models\datori;
use App\Models\specialuser;
use App\Models\EsitoTamponi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EsitoTamponiController extends Controller
{
    function visualizzaEsitoUtenti(){

        $data = ['LoggedUserInfo'=>Utenti::where('id','=', session('LoggedUser'))->first()];
        $verifico = EsitoTamponi::where('IdUtente', '=', session('LoggedUser'))->first();
        if($verifico == NULL)//Non trovo prenotazioni
        {
            return back()->with('fail','Non ci sono ancora esiti.');
        }
        else
        {
            $infop=DB::table('EsitoTamponi')
            ->join('prenotazioni', 'EsitoTamponi.NroPre', '=', 'prenotazioni.NroPren')
            ->select('EsitoTamponi.*', 'prenotazioni.Data','prenotazioni.TipologiaTampone')
            ->where('prenotazioni.IdUtente','=',session('LoggedUser'))
            ->get();
            return view ('utente.EsitoTampone',['infop'=>$infop], $data);   
        }

    }

    function visualizzaEsitoAssistiti(){

        $data = ['LoggedUserInfo'=>medici::where('id','=', session('LoggedUser'))->first()];
        $infom = medici::where('id','=', session('LoggedUser'))->first();
        $verifico = DB::table('EsitoTamponi')
        ->join('prenotazioni', 'EsitoTamponi.NroPre', '=', 'prenotazioni.NroPren')
        ->join('utenti', 'prenotazioni.IdUtente', '=', 'utenti.id')
        ->select('EsitoTamponi.*', 'prenotazioni.Data','prenotazioni.TipologiaTampone')
        ->where('utenti.emailDott', '=', $infom->email)
        ->orderBy("data", "asc")
        ->orderBy("orario", "asc")
        ->get();
        if($verifico==NULL)//Non trovo prenotazioni
        {
            return back()->with('fail','Non ci sono ancora esiti.');
        }
        else
        {
            $infop = DB::table('EsitoTamponi')
            ->join('prenotazioni', 'EsitoTamponi.NroPre', '=', 'prenotazioni.NroPren')
            ->join('utenti', 'prenotazioni.IdUtente', '=', 'utenti.id')
            ->select('EsitoTamponi.*', 'prenotazioni.Data','prenotazioni.TipologiaTampone')
            ->where('utenti.emailDott', '=', $infom->email)
            ->orderBy("data", "asc")
            ->orderBy("orario", "asc")
            ->get();
            return view ('med.VisualizzaEsiti',['infop'=>$infop], $data);   
        }

    }

        
    function ComunicazioneEsitiLab(){


        $data = ['LoggedUserInfo'=>laboratori::where('id','=', session('LoggedUser'))->first()];
        $verifico = DB::table('prenotazioni')
            ->join('laboratori', 'prenotazioni.idLab', '=', 'laboratori.id')
            ->join('esitotamponi', 'esitotamponi.NroPre', '=', 'prenotazioni.NroPren')
            ->select('prenotazioni.*','laboratori.nome')
            ->where('laboratori.id','=', session('LoggedUser'))
            ->where('esitotamponi.Esito','=','da definire')
            ->first();

        if($verifico==NULL)//Non trovo prenotazioni
        {
            return back()->with('fail','Non hai nessun esito da comunicare.');
        }
        else
        {
            $infop=DB::table('prenotazioni')
            ->join('laboratori', 'prenotazioni.idLab', '=', 'laboratori.id')
            ->join('esitotamponi', 'esitotamponi.NroPre', '=', 'prenotazioni.NroPren')
            ->select('prenotazioni.*','laboratori.nome')
            ->where('laboratori.id','=', session('LoggedUser'))
            ->where('esitotamponi.Esito','=','da definire')
            ->orderByRaw('prenotazioni.data')
            ->get();
            
            return view ('lab.ComunicazioneEsiti',['infop'=>$infop],$data);  
        }
        
    }

       
    function ComunicazioneEsitiMed(){


        $data = ['LoggedUserInfo'=>medici::where('id','=', session('LoggedUser'))->first()];
        $verifico = DB::table('prenotazioni')
            ->join('laboratori', 'prenotazioni.idLab', '=', 'laboratori.id')
            ->join('esitotamponi', 'esitotamponi.NroPre', '=', 'prenotazioni.NroPren')
            ->select('prenotazioni.*','laboratori.nome')
            ->where('laboratori.id','=', session('LoggedUser'))
            ->where('esitotamponi.Esito','=','da definire')
            ->first();

        if($verifico==NULL)//Non trovo prenotazioni
        {
            return back()->with('fail','Non hai nessun esito da comunicare.');
        }
        else
        {
            $infop=DB::table('prenotazioni')
            ->join('laboratori', 'prenotazioni.idLab', '=', 'laboratori.id')
            ->join('esitotamponi', 'esitotamponi.NroPre', '=', 'prenotazioni.NroPren')
            ->select('prenotazioni.*','laboratori.nome')
            ->where('laboratori.id','=', session('LoggedUser'))
            ->where('esitotamponi.Esito','=','da definire')
            ->orderByRaw('prenotazioni.data')
            ->get();
            
            return view ('med.comunicazioneEsitiAssistiti',['infop'=>$infop],$data);  
        }
        
    }

    
    function EsitoP($NroPre){
        $np=$NroPre;
        $infop=DB::table('esitotamponi')
        ->where('NroPre',$np)
        ->update(['Esito' => 'Positivo']);
        return redirect('/homelab')->with('success', 'Esito positivo comunicato al prenotato, medico e azienda sanitaria');
    }

    function EsitoN($NroPre){
        $np=$NroPre;
        $infop=DB::table('esitotamponi')
        ->where('NroPre',$np)
        ->update(['Esito' => 'Negativo']);
        return redirect('/homelab')->with('success', 'Esito negativo comunicato al prenotato, medico e azienda sanitaria');
        
    }

    static function creaEsito($lab, $data, $ora)
    {
        $trovato = DB::table('prenotazioni')
        ->select('NroPren', 'IdUtente')
        ->where('idLab', $lab)
        ->where('data', $data)
        ->where('orario', $ora)
        ->first();

            $esito = new esitotamponi;
            $esito-> IdUtente = $trovato->IdUtente;
            $esito-> NroPre = $trovato->NroPren;
            $esito-> Esito = 'da definire';
            $save = $esito->save();
    }


    function visualizzaesitiDatore()
    {
        $data = datori::where('id','=', session('LoggedUser'))->first();
        $verifico = DB::table('EsitoTamponi')
        ->join('prenotazioni', 'EsitoTamponi.NroPre', '=', 'prenotazioni.NroPren')
        ->join('utenti', 'prenotazioni.IdUtente', '=', 'utenti.id')
        ->select('EsitoTamponi.*', 'prenotazioni.Data','prenotazioni.TipologiaTampone')
        ->where('utenti.emailDott', '=', $data->email)
        ->orderBy("data", "asc")
        ->orderBy("orario", "asc")
        ->get();
        if($verifico==NULL)//Non trovo prenotazioni
        {
            return back()->with('fail','Non ci sono ancora esiti.');
        }
        else
        {
            $infop = DB::table('EsitoTamponi')
            ->join('prenotazioni', 'EsitoTamponi.NroPre', '=', 'prenotazioni.NroPren')
            ->join('utenti', 'prenotazioni.IdUtente', '=', 'utenti.id')
            ->select('EsitoTamponi.*', 'prenotazioni.Data','prenotazioni.TipologiaTampone')
            ->where('utenti.emailDott', '=', $data->email)
            ->orderBy("data", "asc")
            ->orderBy("orario", "asc")
            ->get();
            return view ('datore.EsitoTampone',['infop'=>$infop, 'LoggedUserInfo'=>$data]);   
        }
    }

    static function annullaEsito($NroPre)
    {
        esitotamponi::where('NroPre', '=', $NroPre)->delete();
        return;
    }

    function visualizzaEsitiPositiviAsl()
    {
        $verifico = DB::table('esitotamponi')
        ->join('utenti', 'esitotamponi.IdUtente', '=', 'utenti.id')
        ->where('Esito', '=', 'Positivo')
        ->first();
        if($verifico == NULL)
        {
            return back()->with('fail', 'Non ci sono esiti positivi');
        }
        else
        {
            $infop = DB::table('esitotamponi')
            ->join('utenti', 'esitotamponi.IdUtente', '=', 'utenti.id')
            ->join('prenotazioni', 'esitotamponi.NroPre', '=', 'prenotazioni.NroPren')
            ->select('esitotamponi.*', 'utenti.*', 'prenotazioni.TipologiaTampone')
            ->where('esito', '=', 'Positivo')
            ->get();

            $infoNC = DB::table('esitotamponinonconv')
            ->join('medici', 'esitotamponinonconv.idMedico', '=', 'medici.id')
            ->select('medici.*', 'esitotamponinonconv.id as idesito', 'esitotamponinonconv.esito', 'esitotamponinonconv.idMedico', 'esitotamponinonconv.TipTamp')
            ->where('esito', '=', 'Positivo')
            ->get();

            $data = ['LoggedUserInfo' => specialuser::where('id','=', session('LoggedUser'))->first(), 'infop'=>$infop, 'infoNC'=>$infoNC];
            return view('asl.visualizzaPositivi', $data);
        }

        
    }



    function visualizzaNumeroTamponi(){

        $asl = specialuser::where('id','=', session('LoggedUser'))->first();
        $verifico = EsitoTamponi::first();
        
        

        if($verifico == NULL)//Non trovo esiti
        {
            return back()->with('fail','Non ci sono ancora esiti.');
        }
        else
        {
            $infop=DB::table('EsitoTamponi')
            ->join('prenotazioni', 'EsitoTamponi.NroPre', '=', 'prenotazioni.NroPren')
            ->join('laboratori', 'prenotazioni.idLab', '=', 'laboratori.id')
            ->select('EsitoTamponi.*', 'prenotazioni.*', 'laboratori.*', DB::raw('count(*) as total') )
            ->where('esitotamponi.Esito', '=', 'Positivo')
            ->groupBy('laboratori.regione')
            ->get();

            $neg = DB::table('EsitoTamponi')
            ->join('prenotazioni', 'EsitoTamponi.NroPre', '=', 'prenotazioni.NroPren')
            ->join('laboratori', 'prenotazioni.idLab', '=', 'laboratori.id')
            ->select('EsitoTamponi.*', 'prenotazioni.*', 'laboratori.*', DB::raw('count(*) as totalN') )
            ->where('esitotamponi.Esito', '=', 'Negativo')
            ->groupBy('laboratori.regione')
            ->get();

            $data = ['LoggedUserInfo'=>$asl, 'infop'=>$infop, 'neg'=>$neg];
            return view ('asl.visualizzaNumeroTamponi', $data);  

        }

    }
    
}
