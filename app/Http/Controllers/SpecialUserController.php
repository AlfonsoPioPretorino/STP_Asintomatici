<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\specialUser;

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
use Session;


class SpecialUserController extends Controller
{
    function creaUtenteSpec()
    {
        $user = new specialUser;
        $user-> username = $request -> username;
        $user-> password = $request -> password;
        $save = $user->save();
    }


    function approvaConvenzioni()
    {
        $data = ['LoggedUserInfo'=>specialUser::where('id','=', session('LoggedUser'))->first()];
        $verifico = DB::table('laboratori')->where('convenzione','=', false)->first();
        if($verifico == NULL)//Non trovo prenotazioni
        {
            return back()->with('fail','Nessun laboratorio da accettare');
        }
        else
        {
            $infop = laboratori::where('convenzione','=', false)->get();
            return view ('admin.convenzioneLaboratorio', ['infop'=>$infop], $data); 
        }  
    }

    function approvaDatore()
    {
        $data = ['LoggedUserInfo'=>specialUser::where('id','=', session('LoggedUser'))->first()];
        $verifico = DB::table('datori')->where('convenzione','=', false)->first();
        if($verifico == NULL)//Non trovo prenotazioni
        {
            return back()->with('fail','Nessun datore da accettare');
        }
        else
        {
            $infop = datori::where('convenzione','=', false)->get();
            return view ('admin.approvaDatore', ['infop'=>$infop], $data); 
        }  
    }

    function approvaMedico()
    {
        $data = ['LoggedUserInfo'=>specialUser::where('id','=', session('LoggedUser'))->first()];
        $verifico = DB::table('medici')->where('convenzione','=', false)->first();
        if($verifico == NULL)//Non trovo prenotazioni
        {
            return back()->with('fail','Nessun medico da accettare');
        }
        else
        {
            $infop = medici::where('convenzione','=', false)->get();
            return view ('admin.approvaMedico', ['infop'=>$infop], $data); 
        }  
    }

    
}
