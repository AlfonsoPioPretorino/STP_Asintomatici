<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\calendarilab;
use App\Http\Controllers\CalendariolabController;
use App\Models\laboratori;
use App\Models\datori;
use App\Models\tamponi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class DatoriController extends Controller
{
    function saveDat(Request $request){

        //Validazione
        $request ->validate([
            'email' => 'required|email|unique:datori',
            'password' => 'required|min:5'
        ]);

        //Inserisco in db
        $datori = new datori;
        $datori-> nome = $request ->nome;
        $datori-> cognome = $request ->cognome;
        $datori-> codicefiscale = $request ->codicefiscale; 
        $datori-> numerocellulare = $request ->numerocellulare;
        $datori-> regione = $request ->regione;
        $datori-> provincia = $request ->provincia;
        $datori-> citta = $request ->citta;
        $datori-> indirizzo = $request ->indirizzo;
        $datori-> partitaIVA = $request ->partitaIVA;
        $datori-> nomeattivit = $request ->nomeattivit;
        $datori-> email = $request ->email;
        $datori-> password = Hash::make($request ->password);
        $datori-> attore = 'datore';
        $datori-> convenzione = false;
        $save = $datori->save();

        if($save)
        {
            return back()->with('success','Richiesta inoltrata con successo. Prova ad accedere tra qualche ora per verificare lo stato della tua richiesta.');
        }
        else
        {
            return back()->with('fail', 'Qualcosa è andato storto');
        }
    }

    function accettaDatore($id)
    {
        $infop=DB::table('datori')
        ->where('id', '=', $id)
        ->update(['convenzione' => true]);

        return redirect('/homead')->with('success', 'Richiesta del datore approvata con successo.');
    }
    
    function deleteDatore($id)
    {
        $infop=DB::table('datori')
        ->where('id', '=', $id)
        ->delete();

        return redirect('/homead')->with('success', 'Richiesta del datore annullata con successo.');
    }
}
