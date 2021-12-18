<?php

namespace App\Http\Controllers;
use App\Models\esitotamoninonconv;
use App\Models\medici;
use Illuminate\Http\Request;

class EsitiTampNonController extends Controller
{
    function saveEsitoEsterno(Request $request)
    {
        $esit = new esitotamoninonconv;
        $esit-> idMedico = session('LoggedUser');
        $esit-> esito = $request->esito;
        $esit->TipTamp = $request->tiptamp;
        $save = $esit->save();

        return back()->with('success', 'Comunicazione avvenuta');
    }

    function retEsitiEsterni()
    {
        $infop = esitotamoninonconv::where('idMedico', '=', session('LoggedUser'))->get();
        $data = ['LoggedUserInfo'=>medici::where('id','=', session('LoggedUser'))->first(), 'infop'=>$infop];
        return view('med.comunicazioneEsitiAssistiti', $data);
    }
}
