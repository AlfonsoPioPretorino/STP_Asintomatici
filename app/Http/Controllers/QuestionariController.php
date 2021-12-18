<?php

namespace App\Http\Controllers;

use App\Models\Utenti;
use App\Models\User;
use App\Models\laboratori;
use App\Models\coord;
use App\Models\prenotazioni;
use App\Models\EsitoTamponi;
use App\Models\questionari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade as PDF;
use Storage;
use Illuminate\Support\Facades\Redirect;

class QuestionariController extends Controller
{
    function passoPDF(Request $request)
    {
        //Dichiarazioni dati generali
        $questionario = $request;
        $logo = base64_encode(file_get_contents(public_path('img\logopdf.jpg')));
        $infout = prenotazioni::join('utenti', "utenti.id", "=", "prenotazioni.IdUtente")
        ->where("prenotazioni.NroPren", "=", $request->nropre)
        ->first();
        $data = ['LoggedUserInfo'=>laboratori::where('id','=', session('LoggedUser'))->first(), 'questionario'=>$questionario, 'logo'=>$logo, 'infout'=>$infout];

        //Controllo esistenza questionario nel db
        $verifico = questionari::where('NroPren', '=', $request->nropre)->first();
        if($verifico == NULL)
        {
            //Creazione pdf
            $pdf = PDF::loadView('pdf', $data);
            //Dati relativi al percorso e nome del file
            $fileName = 'questionario_'. $questionario->nropre . '.pdf' ;
            //Inserisco numeri di pagina
            $dom_pdf = $pdf->getDomPDF();
            $canvas = $dom_pdf ->get_canvas();
            $canvas->page_text(0, 0, "Pagina {PAGE_NUM} di {PAGE_COUNT}", null, 10, array(0, 0, 0));
            //Salvo PDF
            $pdf->save('questionariLab/' . $fileName);
            //Aggiungo Questionario al db
            self::addDBquestionario($fileName, $request->nropre);
            return Redirect::to('/homelab')->with('success','Questionario inserito e compilato correttamente. Puoi visualizzare il questionario nella sezione relativa.');
        }
        else
        {
            return Redirect::to('/homelab')->with('fail','Questionario già inserito per questa prenotazione.');
        }
        
        

    }

    function addDBquestionario($nomefile, $nropre)
    {
        $percorso = 'questionariLab/'. $nomefile;
        $quest = new questionari;
        $quest -> NroPren = $nropre;
        $quest -> Percorso = $percorso;
        $save = $quest->save();

    }

    function visualizzaQuestionari()
    {
        $data = ['LoggedUserInfo'=>laboratori::where('id','=', session('LoggedUser'))->first()];
        $verifico = questionari::join('prenotazioni', 'prenotazioni.NroPren', '=', 'questionari.NroPren')
        ->select('questionari.*')
        ->where('prenotazioni.idLab', '=', session('LoggedUser'))
        ->first();

        if($verifico == NULL)
        {
            return Redirect::to('/nuovoquestionario')->with('fail','Non hai nessun questionario compilato. Compilane uno nuovo.');
        }
        else
        {
            $quests = DB::table('questionari')
            ->join('prenotazioni', 'prenotazioni.NroPren', '=', 'questionari.NroPren')
            ->join('utenti', 'utenti.id', '=', 'prenotazioni.idUtente')
            ->select('questionari.*', 'utenti.*')
            ->where('prenotazioni.idLab', '=', session('LoggedUser'))
            ->orderBy('NroPren')
            ->get();
            return view('lab.VisualizzaQuestionari', $data, ['quests'=>$quests]);
        }
    }


    function riepilogoQuest(Request $request)
    {
        $questionario = $request;
        $data = ['LoggedUserInfo'=>laboratori::where('id','=', session('LoggedUser'))->first(), 'questionario'=>$questionario];

        return view('lab.RiepilogoQuestionarioAnamnesi', $data);
    }
}
