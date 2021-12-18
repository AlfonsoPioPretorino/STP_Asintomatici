<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\medici;
use App\Models\laboratori;
use App\Models\prenotazioni;
use App\Models\ricevutepagamento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class MediciController extends Controller
{
    function saveMed(Request $request){

        //Validazione
        $request ->validate([
            'email' => 'required|email|unique:medici',
            'password' => 'required|min:5'
        ]);

        //Inserisco in db
        $medico = new medici;
        $medico-> nome = $request ->nome;
        $medico-> cognome = $request ->cognome;
        $medico-> codicefiscale = $request ->codicefiscale; 
        $medico-> numerocellulare = $request ->numerocellulare;
        $medico-> regione = $request ->regione;
        $medico-> provincia = $request ->provincia;
        $medico-> citta = $request ->citta;
        $medico-> indirizzo = $request ->indirizzo;
        $medico-> ASLappartenenza = $request ->asl;
        $medico-> email = $request ->email;
        $medico-> password = Hash::make($request ->password);
        $medico-> attore = 'medico';
        $medico-> convenzione = false;
        $save = $medico->save();

        if($save)
        {
            return back()->with('success','Richiesta inoltrata con successo. Prova ad accedere tra qualche ora per verificare lo stato della tua richiesta.');
        }
        else
        {
            return back()->with('fail', 'Qualcosa è andato storto');
        }
    }


    function visualizzaPrenotazioniMedico()
    {
        $data = ['LoggedUserInfo'=>medici::where('id','=', session('LoggedUser'))->first()];
        
            $infom = medici::where('id','=', session('LoggedUser'))->first();

            $verifico = DB::table('prenotazioni')
            ->join('tamponi', 'prenotazioni.TipologiaTampone', '=', 'tamponi.Tipologia')
            ->join('laboratori', 'prenotazioni.idLab', '=', 'laboratori.id')
            ->join('utenti', 'prenotazioni.IdUtente', '=', 'utenti.id')
            ->join('esitotamponi','prenotazioni.NroPren', '=', 'esitotamponi.NroPre')
            ->join('ricevutepagamento', 'prenotazioni.NroPren', '=', 'ricevutepagamento.NroPren')
            ->select('prenotazioni.*','laboratori.nome', 'tamponi.Prezzo','utenti.codicefiscale', 'esitotamponi.Esito', 'ricevutepagamento.Percorso')
            ->where('utenti.emailDott', '=', $infom->email)
            ->orderBy("data", "asc")
            ->orderBy("orario", "asc")
            ->get();

            if($verifico==NULL)//Non trovo prenotazioni
            {
                return back()->with('fail','Non hai nessuna prenotazione in carico.');
            }
            else
            {
                $infop=DB::table('prenotazioni')
                ->join('tamponi', 'prenotazioni.TipologiaTampone', '=', 'tamponi.Tipologia')
                ->join('laboratori', 'prenotazioni.idLab', '=', 'laboratori.id')
                ->join('utenti', 'prenotazioni.IdUtente', '=', 'utenti.id')
                ->join('esitotamponi','prenotazioni.NroPren', '=', 'esitotamponi.NroPre')
                ->join('ricevutepagamento', 'prenotazioni.NroPren', '=', 'ricevutepagamento.NroPren')
                ->select('prenotazioni.*','laboratori.nome', 'tamponi.Prezzo','utenti.codicefiscale', 'esitotamponi.Esito', 'ricevutepagamento.Percorso')
                ->where('utenti.emailDott', '=', $infom->email)
                ->orderBy("data", "asc")
                ->orderBy("orario", "asc")
                ->get();

                return view ('med.RicevutaPrenotazione',['infop'=>$infop],$data); 
            }
            

    
        
    }


    function accettaMedico($id)
    {
        $infop=DB::table('medici')
        ->where('id', '=', $id)
        ->update(['convenzione' => true,]);

        return redirect('/homead')->with('success', 'Richiesta del Medico approvata con successo.');
    }
    
    function deleteMedico($id)
    {
        $infop=DB::table('medici')
        ->where('id', '=', $id)
        ->delete();

        return redirect('/homead')->with('success', 'Richiesta del Medico annullata con successo.');
    }
}
