<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\calendarilab;
use App\Http\Controllers\CalendariolabController;
use App\Models\laboratori;
use App\Models\Utenti;
use App\Models\tamponi;
use App\Models\medici;
use App\Models\datori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class CalendariolabController extends Controller
{
    function visualizzaCalendario(){
        
        
        $data = ['LoggedUserInfo'=>laboratori::where('id','=', session('LoggedUser'))->first()];
        $verifico = calendarilab::where('id', '=', session('LoggedUser'))->first();

        if($verifico==NULL)//Non trovo prenotazioni
        {
            return back()->with('fail','Non hai ancora un calendario delle prenotazioni. Creane uno e riprova.');
        }
        else
        {
            $infop=DB::table('calendarilab')->where('calendarilab.id','=',session('LoggedUser'))->get();
            return view ('lab.visualizzaCalendario',['infop'=>$infop],$data); 
        }
         
    }



    function salvaCalendario(Request $request)
    {
        $calendarilab = new calendarilab;
        $calendarilab-> id = $request -> id;
        $calendarilab-> giorniSett = $request -> giorniSett;
        $calendarilab-> orarioMin = $request ->orarioMin;
        $calendarilab-> orarioMout = $request ->orarioMout;
        $calendarilab-> orarioPin = $request ->orarioPin;
        $calendarilab-> orarioPout = $request ->orarioPout;
        $calendarilab-> tipologiaTamp = $request ->tipologiaTamp;

        //Verifica esistenza record
        $verifico = new calendarilab;
        $verifico = calendarilab::find($request -> id);


        //Caso in cui il laboratorio non ha nessun calendario inserito in db
        if($verifico == NULL)
        {
            $save = $calendarilab->save();
            if($save)
            {
                return Redirect::to('/homelab/modificacalendario')->with('success','Calendario inserito con successo');
            }
              else
            {
                return back()->with('fail', 'Qualcosa è andato storto');
            }
        }
        else //Elimino la riga contentente il vecchio calendario e carico il nuovo
        {

            calendarilab::where('id', $request->id)->delete();
            $save = $calendarilab->save();
            if($save)
            {
                return Redirect::to('/homelab/modificacalendario')->with('success','Calendario inserito con successo');
            }
              else
            {
                return back()->with('fail', 'Qualcosa è andato storto');
            }
            
        }
            
    }

    function riepilogoCalendario(Request $request)
    {
        $provvisorio = $request;
        $data = ['LoggedUserInfo'=>laboratori::where('id','=', session('LoggedUser'))->first()];
        return view('lab.riepilogoCalendario', ['prov' => $provvisorio], $data);

    }

    function retCalendario($lab)
    {
        if(session('LoggedUser'))
        {
            
            $data = ['LoggedUserInfo'=>Utenti::where('id','=', session('LoggedUser'))->first()];
            $cal = calendarilab::find($lab);
            if($cal != NULL)
            {
                $tamponi = DB::table('tamponi')->get();


                if(session('Attore') == 'utente')
                {
                    $data = ['LoggedUserInfo'=>Utenti::where('id','=', session('LoggedUser'))->first()];
                    return view ('DisponLab', ['cal' => $cal], $data)->with('tamponi', $tamponi); 
                }
                if(session('Attore') == 'datore')
                {

                    if(session()->has('Npren'))
                    {
                        session()->pull('Npren');
                        session()->put('Npren', '0');
                    }

                    $data = ['LoggedUserInfo'=>datori::where('id','=', session('LoggedUser'))->first()];
                    return view ('DisponLab', ['cal' => $cal], $data)->with('tamponi', $tamponi); 
                }
                if(session('Attore') == 'medico')
                {
                    $data = ['LoggedUserInfo'=>medici::where('id','=', session('LoggedUser'))->first()];
                    return view ('DisponLab', ['cal' => $cal], $data)->with('tamponi', $tamponi); 
                }
            }
            else
            { 
                if(session('Attore') == 'utente')
                {
                    $data = ['LoggedUserInfo'=>Utenti::where('id','=', session('LoggedUser'))->first()];
                    return \Redirect::route('home.utente', $data)->with('fail', 'Il laboratorio non disponde ancora di un calendario.');
                }
                if(session('Attore') == 'datore')
                {
                    $data = ['LoggedUserInfo'=>datori::where('id','=', session('LoggedUser'))->first()];
                    return \Redirect::route('home.datore', $data)->with('fail', 'Il laboratorio non disponde ancora di un calendario.');
                }
                if(session('Attore') == 'medico')
                {
                    $data = ['LoggedUserInfo'=>medici::where('id','=', session('LoggedUser'))->first()];
                    return \Redirect::route('home.medico', $data)->with('fail', 'Il laboratorio non disponde ancora di un calendario.');
                }
                if(!session()->has('Attore'))
                {
                    return \Redirect::route('home')->with('fail', 'Il laboratorio non disponde ancora di un calendario.');
                }
                
            }
            
        }
        else
        {
            return Redirect::to('/auth/login')->with('fail', 'Devi autenticarti o registrarti per poter prenotare un tampone.');
        }
    }

    function mapCalendario($lab)
    {
        
        $cal = calendarilab::find($lab);
        if($cal)
        {
            $tamponi = DB::table('tamponi')->get();

            if(session('Attore') == 'utente')
            {
                $data = ['LoggedUserInfo'=>Utenti::where('id','=', session('LoggedUser'))->first(), 'cal'=>$cal, 'tamponi'=>$tamponi];
                return view ('calMappa', $data);
            }
            if(session('Attore') == 'datore')
            {
                $data = ['LoggedUserInfo'=>datori::where('id','=', session('LoggedUser'))->first(), 'cal'=>$cal, 'tamponi'=>$tamponi];
                return view ('calMappa', $data);
            }
            if(session('Attore') == 'medico')
            {
                $data = ['LoggedUserInfo'=>medici::where('id','=', session('LoggedUser'))->first(), 'cal'=>$cal, 'tamponi'=>$tamponi];
                return view ('calMappa', $data);
            }
            if(!session()->has('Attore'))
            {
                return view ('calMappa', ['cal'=>$cal]);
            }
        }
        else
        {

            if(session('Attore') == 'utente')
            {
                $data = ['LoggedUserInfo'=>Utenti::where('id','=', session('LoggedUser'))->first()];
                return \Redirect::route('home.utente', $data)->with('fail', 'Il laboratorio non disponde ancora di un calendario.');
            }
            if(session('Attore') == 'datore')
            {
                $data = ['LoggedUserInfo'=>datori::where('id','=', session('LoggedUser'))->first()];
                return \Redirect::route('home.datore', $data)->with('fail', 'Il laboratorio non disponde ancora di un calendario.');
            }
            if(session('Attore') == 'medico')
            {
                $data = ['LoggedUserInfo'=>medici::where('id','=', session('LoggedUser'))->first()];
                return \Redirect::route('home.medico', $data)->with('fail', 'Il laboratorio non disponde ancora di un calendario.');
            }
            if(!session()->has('Attore'))
            {
                return \Redirect::route('home')->with('fail', 'Il laboratorio non disponde ancora di un calendario.');
            }
        }
        

    }

    
}

