<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utenti;
use App\Models\laboratori;
use App\Models\datori;
use App\Models\User;
use App\Models\medici;
use App\Models\specialUser;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    //Controlla la presenza delle email nel db per l'autenticazione
        function check(Request $request){
            

            //Validazione
            $request->validate([

                'email'=> 'required|email',
                'password' => 'required|min:5'

            ]);

            $userInfo = Utenti::where('email','=', $request->email)->first(); //Trovo utente con quyesta email in db

            if(!$userInfo)//NON TROVO IN UTENTI
            {
                $userInfoL = Laboratori::where('email','=', $request->email)->first(); //Controllo in tabella Laboratori

                    if(!$userInfoL)//NON TROVO LAB
                    {
                        $userInfoD = datori::where('email','=', $request->email)->first(); //Controllo in tabella datori

                        if(!$userInfoD)//NON TROVO DATORI
                        {
                            $userInfoM = medici::where('email','=', $request->email)->first(); //Controllo in tabella medici

                            if(!$userInfoM)//NON TROVO MEDICI
                            {
                                $userInfoS = specialUser::where('email','=', $request->email)->first(); //Controllo in tabella medici

                                if(!$userInfoS)//NON TROVO UTENTI SPECIALI
                                {
                                    return back()->with('fail','Email non trovata');
                                }
                                else //TROVO UTENTE SPECIALE
                                {
                                    if($request->password == $userInfoS->password) //Nel caso trovo l'email in medici controllo la password
                                        {
                                            $request->session()->put("LoggedUser", $userInfoS->id);
                                            $request->session()->put("Attore", $userInfoS->attore);
                                            if($userInfoS->attore == 'admin')
                                            {
                                                return redirect('homeadmin');
                                            }
                                            if($userInfoS->attore == 'asl')
                                            {
                                                return redirect('homeasl');
                                            }
                                            
                                        }
                                    else
                                        {
                                            return back()->with('fail','Password errata');
                                        }
                                }
                            }
                            else //TROVO MEDICO
                            {
                                if(Hash::check($request->password, $userInfoM->password)) //Nel caso trovo l'email in medici controllo la password
                                    {
                                        if($userInfoM->convenzione == false)//Verifica Convenzionamento
                                        {
                                            return back()->with('fail','La tua richiesa non è stata ancora confermata riprova tra qualche ora.'); 
                                        }
                                        else
                                        {
                                            $request->session()->put("LoggedUser", $userInfoM->id, $userInfoM->attore);
                                            $request->session()->put("Attore", $userInfoM->attore);
                                            return redirect('homemed');
                                        }
                                    }
                                else
                                    {
                                        return back()->with('fail','Password errata');
                                    }
                            }
                        }
                        else //TROVO DATORI
                        {
                            if(Hash::check($request->password, $userInfoD->password)) //Nel caso trovo l'email in datori controllo la password
                                {
                                    if($userInfoD->convenzione == false)//Verifica Convenzionamento
                                    {
                                        return back()->with('fail','La tua richiesta non è stata ancora confermata. Riprova tra qualche ora.'); 
                                    }
                                    else
                                    {
                                        $request->session()->put("LoggedUser", $userInfoD->id, $userInfoD->attore);
                                        $request->session()->put("Attore", $userInfoD->attore);
                                        return redirect('homedat');
                                    }
                                    
                                }
                            else
                                {
                                    return back()->with('fail','Password errata');
                                }
                        }
                    }     
                    else //TROVO LABORATORI
                    {
                        if(Hash::check($request->password, $userInfoL->password)) //Nel caso trovo l'email in lab controllo la password
                            {
                                if($userInfoL->convenzione == false)//Verifica Convenzionamento
                                {
                                    return back()->with('fail','La tua richiesta non è stata ancora confermata. Riprova tra qualche ora.'); 
                                }
                                else
                                {
                                    $request->session()->put("LoggedUser", $userInfoL->id, $userInfoL->attore);
                                    $request->session()->put("Attore", $userInfoL->attore);
                                    return redirect('homelab');
                                }
                                
                            }
                        else
                            {
                                return back()->with('fail','Password errata');
                            }
                     }
                        
            }
            else//TROVO UTENTI 
            {
                if(Hash::check($request->password, $userInfo->password))
                {
                    $request->session()->put("LoggedUser", $userInfo->id);
                    $request->session()->put("Attore", $userInfo->attore);
                    return redirect('homeut');
                }
                else
                {
                    return back()->with('fail','Password errata');
                }
            }
        }
 
}
