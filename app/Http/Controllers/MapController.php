<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\coord;
use App\Models\laboratori;
use App\Models\utenti;
use App\Models\medici;
use App\Models\datori;
use Illuminate\Support\Facades\DB;
use Session;

class MapController extends Controller
{
    function cercaCitta(Request $request)
    {

        $comune = coord::where('comune','=', $request->citta)->first();
        if(!$comune)//Non trova comune
        {
            return back()->with('fail','Comune non trovato o non inserito');
        }
        else
        {
            
            $coord =['InfoCitta'=>coord::where('istat','=', $comune->istat)->first()];

           if(session('Attore') == 'utente')
                {
                    $data = ['LoggedUserInfo'=>Utenti::where('id','=', session('LoggedUser'))->first()];
                    return view('findlab', $coord, $data);
                }
            if(session('Attore') == 'datore')
                {
                    $data = ['LoggedUserInfo'=>datori::where('id','=', session('LoggedUser'))->first()];
                    return view('findlab', $coord, $data);
                }
            if(session('Attore') == 'medico')
                {
                    $data = ['LoggedUserInfo'=>medici::where('id','=', session('LoggedUser'))->first()];
                    return view('findlab', $coord, $data);
                }
            if(!session()->has('Attore'))
                {
                    return view('findlab', $coord);
                }
            
            return back()->with('fail', 'Ops, qualcosa è andato storto');
             
        }
    }


    function api()
    {   
        return laboratori::all();
    }
}
