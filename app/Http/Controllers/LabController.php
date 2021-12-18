<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\laboratori;
use App\Models\prenotazioni;
use App\Http\Controllers\LabController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LabController extends Controller
{
    function saveLab(Request $request){

        //Validazione
        $request ->validate([
            'nome' => 'required',
            'email' => 'required|email|unique:laboratori',
            'numerocellulare' => 'required',
            'regione' => 'required',
            'provincia' => 'required',
            'citta' => 'required',
            'indirizzo' => 'required',
            'password' => 'required|min:5'

        ]);

        //Inserisco in db
        $laboratori = new Laboratori;
        $laboratori-> nome = $request ->nome;
        $laboratori-> email = $request ->email;
        $laboratori-> numerocellulare = $request ->numerocellulare;
        $laboratori-> regione = $request ->regione;
        $laboratori-> provincia = $request ->provincia;
        $laboratori-> citta = $request ->citta;
        $laboratori-> indirizzo = $request ->indirizzo;
        $laboratori-> password = Hash::make($request ->password);
        $laboratori-> attore = 'lab';
        $laboratori-> convenzione = false;
        $save = $laboratori->save();

        if($save)
        {
            return redirect('/')->with('success','La tua richiesta è stata inviata con successo. Prova ad accedere tra qualche ora per verificare lo stato della tua richiesta.');
        }
        else
        {
            return back()->with('fail', 'Qualcosa è andato storto');
        }
    }

    function visualizzaPrenotazioniLab()
    {
        $data = ['LoggedUserInfo'=>laboratori::where('id','=', session('LoggedUser'))->first()];
        $verifico = prenotazioni::where('idLab', '=', session('LoggedUser'))->first();

        if($verifico==NULL)//Non trovo prenotazioni
        {
            return back()->with('fail','Non hai nessuna prenotazione in carico.');
        }
        else
        {
            $infop=DB::table('prenotazioni')
            ->join('tamponi', 'prenotazioni.TipologiaTampone', '=', 'tamponi.Tipologia')
            ->join('laboratori', 'prenotazioni.IdLab', '=', 'laboratori.id')
            ->join('utenti', 'prenotazioni.IdUtente', '=', 'utenti.id')
            ->join('esitotamponi','prenotazioni.NroPren', '=', 'esitotamponi.NroPre')
            ->select('prenotazioni.*', 'tamponi.Prezzo','utenti.nome','utenti.cognome','utenti.codicefiscale', 'esitotamponi.Esito')
            ->where('prenotazioni.idLab','=',session('LoggedUser'))
            ->orderBy("data", "asc")
            ->orderBy("orario", "asc")
            ->get();

            return view ('lab.VisualizzaPrenotazioni',['infop'=>$infop],$data); 
        }
    }

    function setLatLng(Request $request)
    {
        $infop=DB::table('laboratori')
        ->where('id', '=', $request->idlab)
        ->update(['latitudine' => $request->latitudine,
                  'longitudine' => $request->longitudine,
                  'convenzione' => true,
        ]);

        return redirect('/homead')->with('success', 'Convenzione laboratorio avvenuta con successo.');
    }

    function deleteRichiesta($id)
    {
        DB::table('laboratori')->where('id', '=', $id)->delete();
        return redirect('/homead')->with('success', 'Convenzione laboratorio negata con successo.');
    }


    
}
