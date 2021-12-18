<?php

namespace App\Http\Controllers;

use App\Models\medici;
use App\Models\laboratori;
use App\Models\tamponi;
use App\Models\prenotazioni;
use App\Models\utenti;
use App\Models\ricevutepagamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade as PDF;
use Storage;
use Illuminate\Support\Facades\Redirect;

class RicevutePagamentoController extends Controller
{
    static function genPDFRicevuta($ricevuta, $nropre)
    {
        //Dichiarazioni dati generali
        $logo = base64_encode(file_get_contents(public_path('img\logopdf.jpg')));

        $infomed = medici::where('id', '=', $ricevuta->iddoc)->first();
        $infout = utenti::where('email', '=', $ricevuta->email)->first();
        $infolab = laboratori::where('id', '=', $ricevuta->id)->first();
        $infotamp = tamponi::join('prenotazioni', 'prenotazioni.TipologiaTampone', '=', 'tamponi.Tipologia')->first();

        //Raggruppo i dati per la vista
        $data = ['infomed'=>$infomed, 'infout'=>$infout, 'infotamp'=>$infotamp, 'logo'=>$logo, 'nropre'=>$nropre, 'infolab'=>$infolab];
        

        //Creazionepdf
        $pdf = PDF::loadView('PDFricevutapagamento', $data);
        $fileName = 'ricevutapagamento_'. $nropre->NroPren . '.pdf' ;

        //Inserisco numeri di pagina
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf ->get_canvas();
        $canvas->page_text(0, 0, "Pagina {PAGE_NUM} di {PAGE_COUNT}", null, 10, array(0, 0, 0));

        //Salvo PDF
        $pdf->save('ricevutepagamento/' . $fileName);
        self::addDBricevuta($fileName, $nropre->NroPren);
        return $pdf->stream();
        
    }

    static function addDBricevuta($nomefile, $nopre)
    {
        $percorso = 'ricevutepagamento/'. $nomefile;
        $ricev = new ricevutepagamento;
        $ricev -> NroPren = $nopre;
        $ricev -> Percorso = $percorso;
        $save = $ricev->save();
    }
}
