<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utenti;
use App\Models\User;
use App\Models\medici;
use Illuminate\Support\Facades\Hash;

class UtentiRegistratiController extends Controller
{
    //Valida e salva i dati inseriti nel form di registrazione
    //nel tabella utenti

    function saveUtenti(Request $request){
       
        //Validazione
        $request ->validate([
            'nome' => 'required',
            'cognome' => 'required',
            'codicefiscale' => 'required',
            'numerocellulare' => 'required',
            'regione' => 'required',
            'provincia' => 'required',
            'citta' => 'required',
            'indirizzo' => 'required',
            'email' => 'required|email|unique:utenti',
            'password' => 'required|min:5'

        ]);

        //Inserisco in db
        $utenti = new Utenti;
        $utenti-> nome = $request ->nome;
        $utenti-> cognome = $request ->cognome;
        $utenti-> codicefiscale = $request ->codicefiscale;
        $utenti-> datadinascita = $request ->data;
        $utenti-> numerocellulare = $request ->numerocellulare;
        $utenti-> regione = $request ->regione;
        $utenti-> provincia = $request ->provincia;
        $utenti-> citta = $request ->citta;
        $utenti-> indirizzo = $request ->indirizzo;
        $utenti-> email = $request ->email;
        $utenti-> emailDott = NULL;
        $utenti-> password = Hash::make($request ->password);
        $utenti-> attore = 'utente';
        $save = $utenti->save();

        if($save)
        {
            return back()->with('success','Registrazione confermata');
        }
        else
        {
            return back()->with('fail', 'Qualcosa è andato storto');
        }
    }

    static function creaAssistito($info, $emailDoc)
    {
        $utenti = new Utenti;
        $utenti-> nome = $info ->nome;
        $utenti-> cognome = $info ->cognome;
        $utenti-> codicefiscale = $info ->codicefiscale;
        $utenti-> datadinascita = $info ->datadinascita;
        $utenti-> numerocellulare = $info ->numerocellulare;
        $utenti-> regione = NULL;
        $utenti-> provincia = NULL;
        $utenti-> citta = NULL;
        $utenti-> indirizzo = NULL;
        $utenti-> email = $info ->email;
        $utenti-> emailDott = $emailDoc;
        $utenti-> password = NULL;
        $utenti-> attore = 'assistito';
        $save = $utenti->save();
    }
    
    static function creaDipendente($info, $emailDat)
    {
        $utenti = new Utenti;
        $utenti-> nome = $info ->nome;
        $utenti-> cognome = $info ->cognome;
        $utenti-> codicefiscale = $info ->codicefiscale;
        $utenti-> datadinascita = $info ->datadinascita;
        $utenti-> numerocellulare = $info ->numerocellulare;
        $utenti-> regione = NULL;
        $utenti-> provincia = NULL;
        $utenti-> citta = NULL;
        $utenti-> indirizzo = NULL;
        $utenti-> email = $info ->email;
        $utenti-> emailDott = $emailDat;
        $utenti-> password = NULL;
        $utenti-> attore = 'dipentente';
        $save = $utenti->save();
    }
    
}
