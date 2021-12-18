<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\prenotazioni;
use App\Models\utenti;
use App\Models\laboratori;
use App\Models\calendario;
use App\Models\EsitoTamponi;
use App\Models\datori;
use App\Models\medici;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PrenotazioniController;
use App\Http\Controllers\EsitoTamponiController;
use App\Http\Controllers\UtentiRegistratiController;
use App\Http\Controllers\RicevutePagamentoController;
use App\Http\Controllers\RicevutePrenotazioniController;
use App\Models\ricevuteprenotazioni;
use Session;

class PrenotazioniController extends Controller
{
    

    //Più di una utenti
    function visualizzaPrenotazioni(){
        
        $data = ['LoggedUserInfo'=>Utenti::where('id','=', session('LoggedUser'))->first()];

        $verifico = prenotazioni::where('IdUtente', '=', session('LoggedUser'))->first();
        if($verifico==NULL)//Non trovo prenotazioni
        {
            return back()->with('fail','Non hai effettuato nessuna prenotazione');
        }
        else
        {
            $infop=DB::table('prenotazioni')
            ->join('tamponi', 'prenotazioni.TipologiaTampone', '=', 'tamponi.Tipologia')
            ->join('laboratori', 'prenotazioni.IdLab', '=', 'laboratori.id')
            ->select('prenotazioni.*', 'tamponi.Prezzo','laboratori.nome')
            ->where('prenotazioni.IdUtente','=',session('LoggedUser'))
            ->get();
            return view ('utente.visualizzaPrenotazioni',['infop'=>$infop],$data); 
        }  
    }


    //una sola per la conferma
    function visualizzaPrenotazione($NroPren)
    {
        $np=$NroPren;
        
        $data = ['LoggedUserInfo'=>Utenti::where('id','=', session('LoggedUser'))->first()];
        $infop=DB::table('prenotazioni')
            ->join('tamponi', 'prenotazioni.TipologiaTampone', '=', 'tamponi.Tipologia')
            ->join('laboratori', 'prenotazioni.IdLab', '=', 'laboratori.id')
            ->select('prenotazioni.*', 'tamponi.Prezzo','laboratori.nome')
            ->where('prenotazioni.NroPren','=',$np)
            ->first();
            return view ('utente.visualizzaPrenotazione',['infop'=>$infop],$data); 
    }

    function visualizzaPrenotazioneDat($NroPren)
    {
        $np=$NroPren;
        
        $data = ['LoggedUserInfo'=>datori::where('id','=', session('LoggedUser'))->first()];
        $infop=DB::table('prenotazioni')
            ->join('tamponi', 'prenotazioni.TipologiaTampone', '=', 'tamponi.Tipologia')
            ->join('laboratori', 'prenotazioni.IdLab', '=', 'laboratori.id')
            ->select('prenotazioni.*', 'tamponi.Prezzo','laboratori.nome')
            ->where('prenotazioni.NroPren','=',$np)
            ->first();
            return view ('datore.visualizzaPrenotazione',['infop'=>$infop],$data); 
    }

    function visualizzaPrenotazioneMed($NroPren)
    {
        $np=$NroPren;
        
        $data = ['LoggedUserInfo'=>medici::where('id','=', session('LoggedUser'))->first()];
        $infop=DB::table('prenotazioni')
            ->join('tamponi', 'prenotazioni.TipologiaTampone', '=', 'tamponi.Tipologia')
            ->join('laboratori', 'prenotazioni.IdLab', '=', 'laboratori.id')
            ->select('prenotazioni.*', 'tamponi.Prezzo','laboratori.nome')
            ->where('prenotazioni.NroPren','=',$np)
            ->first();
            return view ('med.visualizzaPrenotazione',['infop'=>$infop],$data); 
    }


    function annullaPrenotazione($NroPren)
    {
        if(session()->has('pagamento'))
        {
            session()->pull('pagamento');
        }

        $np=$NroPren;
        $infop=DB::table('prenotazioni')
        ->where('NroPren',$np)->delete();
        EsitoTamponiController::annullaEsito($np);
        
        return redirect('/homeut')->with('success','Prenotazione annullata');
        
    }

    function cancellaPrenotazioneDat($NroPren){
        
        $np=$NroPren;
        //trovo id dipentente
        $iddip = DB::table('prenotazioni')
        ->join('utenti', 'prenotazioni.idUtente', '=', "utenti.id")
        ->where('NroPren', '=', $np)
        ->first();
        //elimino prenotazione
        DB::table('prenotazioni')->where('NroPren', '=', $np)->delete();
        //elimino dipendente
        DB::table('utenti')->where('id', '=', $iddip->id)->delete();
        EsitoTamponiController::annullaEsito($np);

        $data = ['LoggedUserInfo'=> datori::where('id','=', session('LoggedUser'))->first()];
        return \Redirect::route('home.datore', $data)->with('success','Prenotazione annullata');
        
    }

    function cancellaPrenotazioneMed($NroPren)
    {
        if(session()->has('pren'))
        {
            session()->pull('pren');
        }
        $np=$NroPren;
        //trovo id dipentente
        $iddip = DB::table('prenotazioni')
        ->join('utenti', 'prenotazioni.idUtente', '=', "utenti.id")
        ->where('NroPren', '=', $np)
        ->first();
        //elimino prenotazione
        DB::table('prenotazioni')->where('NroPren', '=', $np)->delete();
        //elimino assisitio
        DB::table('utenti')->where('id', '=', $iddip->id)->delete();
        EsitoTamponiController::annullaEsito($np);
        //elimino ricevuta pagamento
        DB::table('ricevutepagamento')->where('NroPren', '=', $np)->delete();

        $data = ['LoggedUserInfo'=> medici::where('id','=', session('LoggedUser'))->first()];
        return \Redirect::route('home.medico', $data)->with('success','Prenotazione annullata');
    }

    function verificaPrenotazioni(Request $request)
    {

        //Controllo se nella sessione è stata fatta una prenotazione presso un altro laboratorio
        if(session()->has('idLab'))
        {
            session()->pull('idLab');
        }
        $idlab = $request->id;
        $data = $request->data;
        $orario = $request->orario;

        $check = 0;         //Variabile di controllo di disponiblità
        $diverso = 0;       //Controllo ciclo per giorni diversi
        $iterazioni = 0;    //Secondo controllo per ciclo dei giorni diversi

        //Verifico il giorno della settimana della data
        $giorno = DB::table('calendario')->where('data','=', $data)->first();
        $CLU = $giorno->giornosett;
        //Prendo il calendario lab
        $callab = DB::table('calendarilab')->where('id', '=', $idlab)->first();

        //Prendo orario chiusura e apertura e converto in time di php
        $orarioMapertura = $callab->orarioMin;
        $orarioMchiusura = $callab->orarioMout;
        $orarioPapertura = $callab->orarioPin;
        $orarioPchiusura = $callab->orarioPout;

        //Converto in time di php
        $orarioTime = $orario;

        //Converto in array i giorni lavorativi
        $giorniLavorativi = json_decode($callab->giorniSett);


        //Orario valido 
        if($orarioTime >= $orarioMapertura && $orarioTime < $orarioMchiusura || $orarioTime >= $orarioPapertura && $orarioTime < $orarioPchiusura)
        {
            foreach($giorniLavorativi as $item) 
            { 
                $iterazioni++;

                if($item == $CLU)//Se la data inserita corrisponde ad un giorno di lavoro del lab 
                {
                    //Prendo tutte le prenotazioni già presenti di quel laboratorio
                    $books = prenotazioni::where('idLab', $idlab)->get();

                    foreach($books as $book)
                    {
                        
                        if($book->Orario == $orarioTime && $book->Data == $data)
                        {
                            $check = $check + 1;
                            break;
                        }

                    }

                }
                else
                {
                    $diverso++;
                }
                
            }
            if($iterazioni == $diverso)//Se il numero di iterazioni è == al numero di giorni diversi trovati, allora vuol dire che l'utente ha inserito un giorno non lavorativo per il lab
            {
                return back()->with('fail', 'Il laboratorio non effettua tamponi in quel giorno della settimana. Riprova.');
            }
            if($check==0)
            {
                //Prenotazione per Utente
                if(session('Attore') == 'utente')
                {
                    self::creaPrenotazione($idlab, $data, $orarioTime, $request->tiptamp, $request->idut, $request->tippag, 0);
                    if($request->tippag == 'Online')
                    {
                        session()->put('pagamento', 'online');
                        $ut = Utenti::where('id', '=', session('LoggedUser'))->first();
                        $prenot = prenotazioni::orderBy('NroPren', 'desc')->first();
                        $data = ['infop'=>$request, 'LoggedUserInfo'=>$ut, 'prenot'=>$prenot];
                        return view('utente.riepilogoPrenotazione', $data);
                    }
                    else if($request->tippag == 'Laboratorio')
                    {
                        session()->put('pagamento', 'laboratorio');
                        $ut = Utenti::where('id', '=', session('LoggedUser'))->first();
                        $prenot = prenotazioni::orderBy('NroPren', 'desc')->first();
                        $data = ['infop'=>$request, 'LoggedUserInfo'=>$ut, 'prenot'=>$prenot];
                        return view('utente.riepilogoPrenotazione', $data);
                    }
                }
                //Prenotazione per assistito
                if(session('Attore') == 'medico')
                {
                    $medico = medici::where('id','=', session('LoggedUser'))->first();
                    UtentiRegistratiController::creaAssistito($request, $medico->email);
                    $idAs = DB::table('utenti')->where('email', '=', $request->email)->first();
                    self::creaPrenotazione($idlab, $data, $orarioTime, $request->tiptamp, $idAs->id, 'Laboratorio', 0);
                    //Genero ricevuta pagamento per il medico
                    $pre = prenotazioni::orderBy('NroPren', 'desc')->first();
                    RicevutePagamentoController::genPDFRicevuta($request, $pre);

                    session()->put('pren', 'med');
                    $data = ['LoggedUserInfo'=>$medico, 'prenot'=>$pre, 'infop'=>$request];
                    return view('med.riepilogoPrenotazione', $data);
                }
                //Prenotazione per dipendente
                if(session('Attore') == 'datore')
                {
                    $datore = datori::where('id','=', session('LoggedUser'))->first();

                    UtentiRegistratiController::creaDipendente($request, $datore->email);
                    $idDip = DB::table('utenti')->where('email', '=', $request->email)->first();
                    self::creaPrenotazione($idlab, $data, $orarioTime, $request->tiptamp, $idDip->id, 'Online', 0);
                    $npre = session('Npren') + 1;

                    session()->pull('Npren');
                    session()->put('Npren', $npre);
                    session()->put('idLab', $request->id);

                    $pre = prenotazioni::orderBy('NroPren', 'desc')->first();
                    RicevutePrenotazioniController::genPDFricevutaTampone($request, $pre);

                    
                    return redirect('/riepilogopren');

                    //return back()->with('success', 'Prenotazione effettuata con successo.');
                }
               
               
            }
            else
            {   
                return back()->with('fail', 'Esiste già una prenotazione con questa data e orario. Riprova.');
            }
        }
        else
        {
            return back()->with('fail', 'Orario non valido. Riprova.');
        }

    }


    function creaPrenotazione($lab, $date, $ora, $tiptamp, $utente, $tippag, $modcreazione)
    {
        if($modcreazione == 0)//Crea prenotazione con annesso esito
        {
            $prenotazione = new prenotazioni;
            $prenotazione-> data = $date;
            $prenotazione-> orario = $ora;
            $prenotazione-> idLab = $lab;
            $prenotazione-> TipologiaTampone = $tiptamp;
            $prenotazione-> IdUtente = $utente;
            $prenotazione-> Pagamento = $tippag;
            $save = $prenotazione->save();
            EsitoTamponiController::creaEsito($lab, $date, $ora);
        }
        else if($modcreazione == 1)//Crea esclusivamente la prenotazione 
        {
            $prenotazione = new prenotazioni;
            $prenotazione-> data = $date;
            $prenotazione-> orario = $ora;
            $prenotazione-> idLab = $lab;
            $prenotazione-> TipologiaTampone = $tiptamp;
            $prenotazione-> IdUtente = $utente;
            $prenotazione-> Pagamento = $tippag;
            $save = $prenotazione->save();
        }
        

    }

    function riepPrenDatore()
    {   
        $lab = session('idLab');
        $datore = datori::where('id','=', session('LoggedUser'))->first();
        $dip = utenti::where('emailDott', '=', $datore->email)->orderBy('id','desc')->first();
        $prenot = prenotazioni::orderBy('NroPren', 'desc')->first();
        $data = ['LoggedUserInfo'=>$datore, 'dip'=>$dip, 'prenot'=>$prenot, 'lab'=>$lab];


        return view('datore.RiepPren', $data);
    }

    function annullaPrenotazioneDat($NroPren)
    {
        $lab = session('idLab');
        $np=$NroPren;
        //elimino esito
        DB::table('esitotamponi')->where('NroPre', '=', $np)->delete();
        //trovo id dipentente
        $iddip = DB::table('prenotazioni')
        ->join('utenti', 'prenotazioni.idUtente', '=', "utenti.id")
        ->where('NroPren', '=', $np)
        ->first();
        //elimino prenotazione
        DB::table('prenotazioni')->where('NroPren', '=', $np)->delete();
        //elimino dipendente
        DB::table('utenti')->where('id', '=', $iddip->id)->delete();
        //decremento il numero di prenotazioni
        $npre = session('Npren') - 1;
        session()->pull('Npren');
        session()->put('Npren', $npre);

        return \Redirect::route('disp.lab', $lab)->with('success','Prenotazione annullata');
    }

    function visualizzaprenDatore()
    {
        $data= datori::where('id','=', session('LoggedUser'))->first();
        $verifico =  DB::table('prenotazioni')
                    ->join('utenti', 'prenotazioni.idUtente', '=', "utenti.id")
                    ->where('utenti.emailDott', '=', $data->email)
                    ->first();
        if($verifico==NULL)//Non trovo prenotazioni
        {
            return back()->with('fail','Non hai effettuato nessuna prenotazione');
        }
        else
        {
            $infop=DB::table('prenotazioni')
            ->join('utenti', 'prenotazioni.idUtente', '=', "utenti.id")
            ->join('tamponi', 'prenotazioni.TipologiaTampone', '=', 'tamponi.Tipologia' )
            ->join('ricevuteprenotazioni', 'ricevuteprenotazioni.NroPren', '=', 'prenotazioni.NroPren')
            ->where('utenti.emailDott', '=', $data->email)
            ->get();
            return view ('datore.VisualizzaPrenotazioni',['infop'=>$infop, 'LoggedUserInfo'=>$data]); 
        }  
    }
    

    
}
