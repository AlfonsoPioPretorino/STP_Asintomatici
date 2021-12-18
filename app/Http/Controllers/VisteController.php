<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utenti;
use App\Models\User;
use App\Models\datori;
use App\Models\laboratori;
use App\Models\coord;
use App\Models\medici;
use App\Models\specialUser;
use Illuminate\Support\Facades\Hash;
use Session;

class VisteController extends Controller
{

    //Funzioni per ritorno viste
    function home()
    {
        return view('HomeFruitore');
    }
    function login ()
    {
        return view('auth.login');
    }

    function register ()
    {
        return view('auth.register');
    }

    function homeut ()
    {
        if(session()->has('pagamento'))
        {
            if(session('pagamento') == 'laboratorio')
            {
                $data = ['LoggedUserInfo'=>Utenti::where('id','=', session('LoggedUser'))->first()];
                session()->pull('pagamento');
                return \Redirect::route('home.utente', $data)->with('success','Prenotazione effettuata. Pagerai il costo del tampone nel laboratorio da lei scelto.');
            }
            if(session('pagamento') == 'online')
            {
                $data = ['LoggedUserInfo'=>Utenti::where('id','=', session('LoggedUser'))->first()];
                session()->pull('pagamento');
                return \Redirect::route('home.utente', $data)->with('success','Prenotazione e pagamento effettuati con successo.');  
            }
        }
        else
        {
            $data = ['LoggedUserInfo'=>Utenti::where('id','=', session('LoggedUser'))->first()];
            return view('utente.HomeUtente', $data);
        }
        
    }

    function homedat ()
    {
        $data = ['LoggedUserInfo'=>datori::where('id','=', session('LoggedUser'))->first()];
        return view('datore.homeDatore', $data);
    }

    function homemed()
    {
        if(session()->has('pren'))
        {
            session()->pull('pren');
            $data = ['LoggedUserInfo'=>medici::where('id','=', session('LoggedUser'))->first()];
            return \Redirect::route('home.medico', $data)->with('success', 'Prenotazione effettuato con successo. Ricorda di scaricare la ricevuta di prenotazione e consegnarla all assistito.');  

        }
        else
        {
            $data = ['LoggedUserInfo'=>medici::where('id','=', session('LoggedUser'))->first()];
            return view('med.homeMedico', $data);
        }
       
    }
    function homead()
    {
        $data = ['LoggedUserInfo'=>specialUser::where('id','=', session('LoggedUser'))->first()];
        return view('admin.homeadmin', $data);
    }

    function homeasl()
    {
        $data = ['LoggedUserInfo'=>specialUser::where('id','=', session('LoggedUser'))->first()];
        return view('asl.homeasl', $data);
    }

    function logout()
    {
        if(session()->has('LoggedUser'))
        {
            if(session()->has('Npren'))
            {
                session()->pull('Npren');
            }
            if(session()->has('idLab'))
            {
                session()->pull('idLab');
            }
            session()->pull('LoggedUser');
            session()->pull('Attore');
            return redirect('/');
        }
    }

    function convenzionati()
    {
        return view('lab.convenzionati');
    }

    function homelab()
    {
        $data = ['LoggedUserInfo'=>laboratori::where('id','=', session('LoggedUser'))->first()];
        return view('lab.homelab', $data);
    }

    function modificacalendario()
    {
        $data = ['LoggedUserInfo'=>laboratori::where('id','=', session('LoggedUser'))->first()];
        return view('lab.modificacalendario', $data);
    }
    
    function cittatrovata()
    {
        $coord =['InfoCitta'=>coord::where('istat','=', session('comune'))->first()];
        return view('findlab', $coord);
    }

    function disponibilita()
    {
        if(session('LoggedUser', 'attore') == 'utenti')
        {
            $data = ['LoggedUserInfo'=>Utenti::where('id','=', session('LoggedUser'))->first()];
        }
        else if(session('LoggedUser', 'attore') == 'datore')
        {
            $data = ['LoggedUserInfo'=>datori::where('id','=', session('LoggedUser'))->first()];
        }
        else if(session('LoggedUser', 'attore') == 'med')
        {
            session()->put('Npren', '0');
            $data = ['LoggedUserInfo'=>medici::where('id','=', session('LoggedUser'))->first()];
        }
        
        return view('DisponLab', $data);
    }
    
    function gpsMap()
    {

        if(session('Attore') == 'utente')
        {
            $data = ['LoggedUserInfo'=>Utenti::where('id','=', session('LoggedUser'))->first()];
            return view('geolab', $data);
        }
        if(session('Attore') == 'datore')
        {
            if(session()->has('Npren'))
                {
                    session()->pull('Npren');
                    session()->put('Npren', '0');
                }
            $data = ['LoggedUserInfo'=>datori::where('id','=', session('LoggedUser'))->first()];
            return view('geolab', $data);
        }
        if(session('Attore') == 'med')
        {
            $data = ['LoggedUserInfo'=>medici::where('id','=', session('LoggedUser'))->first()];
            return view('geolab', $data);
        }
        if(!session()->has('Attore'))
        {
            return view('geolab');
        }
        
    }
    
    function pagSuccess()
    {
        
        return redirect('/homeut')->with('success','Pagamento avvenuto con successo.');
    }

    function nuovoQuestionario()
    {
        $data = ['LoggedUserInfo'=>laboratori::where('id','=', session('LoggedUser'))->first()];
        return view('lab.QuestionarioAnamnesi', $data);
    }

    function vistaPagamento()
    {
        return view('pagamento');
    }

    function asdrubale()
    {
        return view('HomeFruitore');
    }

   
    function registerDatore ()
    {
        return view('datore.registerDatore');
    }

    function registerMedico()
    {
        return view('med.registerMedico');
    }

    function CompilaEsitiEsterniMed()
    {
        $data = ['LoggedUserInfo'=>medici::where('id','=', session('LoggedUser'))->first()];
        return view('med.CompComEsito', $data);
    }



}