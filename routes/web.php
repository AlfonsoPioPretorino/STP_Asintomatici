<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisteController;
use App\Http\Controllers\UtentiRegistratiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\CalendariolabController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\PrenotazioniController;
use App\Http\Controllers\EsitoTamponiController;
use App\Http\Controllers\QuestionariController;
use App\Http\Controllers\DatoriController;
use App\Http\Controllers\MediciController;
use App\Http\Controllers\EsitiTampNonController;
use App\Http\Controllers\SpecialUserController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Viste
Route::get('/', [VisteController::class, 'home'])->name('home');
Route::get('/homelab', [VisteController::class, 'homelab'])->name('lab.homelab');
Route::get('/homeut', [VisteController::class, 'homeut'])->name('home.utente');
Route::get('/homead', [VisteController::class, 'homead'])->name('home.admin');
Route::get('/homedat', [VisteController::class, 'homedat'])->name('home.datore');
Route::get('/homemed', [VisteController::class, 'homemed'])->name('home.medico');
Route::get('/disponiblita/{lab}', [CalendariolabController::class, 'retCalendario'])->name('disp.lab');
Route::get('/cittatrovata', [VisteController::class, 'cittatrovata'])->name('map.cittatrovata');
Route::get('/map/calendario/{lab}', [CalendariolabController::class, 'mapCalendario'])->name('map.calendario');

//Autenticazione
Route::get('/auth/login', [VisteController::class, 'login'])->name('auth.login');
Route::post('/auth/check', [LoginController::class, 'check'])->name('auth.check');

//Registrazione Utente
Route::get('/auth/register', [VisteController::class, 'register'])->name('auth.register');
Route::post('/auth/save', [UtentiRegistratiController::class, 'saveUtenti'])->name('auth.save');

//Convenzionamento Lab
Route::get('/lab/convenzionati', [VisteController::class, 'convenzionati'])->name('lab.convenzionati');
Route::post('/lab/save', [LabController::class, 'saveLab'])->name('lab.save');

//Registrazione Datore
Route::get('/dat/registerDatore', [VisteController::class, 'registerDatore'])->name('datore.register');
Route::post('/dat/save', [DatoriController::class, 'saveDat'])->name('dat.save');


//Registrazione Medico
Route::get('/medico/registerMedico', [VisteController::class, 'registerMedico'])->name('med.register');
Route::post('/medico/saveMed', [MediciController::class, 'saveMed'])->name('med.save');

//Logout
Route::get('/auth/logout', [VisteController::class, 'logout'])->name('auth.logout');


//Laboratorio
//Laboratorio calendario
Route::get('/homelab/modificacalendario', [VisteController::class, 'modificacalendario'])->name('lab.modificacalendario');
Route::post('/homelab/riepilogoCalendario', [CalendariolabController::class, 'riepilogoCalendario'])->name('lab.riepilogoCalendario');
Route::post('/homelab/saveCalendario', [CalendariolabController::class, 'salvaCalendario'])->name('lab.saveCalendario');
Route::get('/homelab/visualizzaCalendario',[CalendariolabController::class, 'visualizzaCalendario'])->name('lab.visualizzaCalendario');
Route::get('/homelab/VisualizzaLaboratorio',[LabController::class, 'visualizzaPrenotazioniLab'])->name('lab.visualizzaPrenotazioni');

//Laboratorio Esiti
Route::get('/ComunicazioneEsiti', [EsitoTamponiController::class,'ComunicazioneEsitiLab'])->name('lab.ComunicazioneEsiti');
Route::get('EsitoP/{NroPre}', [EsitoTamponiController::class,'EsitoP'])->name('EsitoP');
Route::get('EsitoN/{NroPre}', [EsitoTamponiController::class,'EsitoN'])->name('EsitoN');

//Laboratorio questionari
Route::get('/nuovoquestionario', [VisteController::class,'nuovoQuestionario'])->name('lab.nuovoQuest');
Route::post('/riepilogoquestionario', [QuestionariController::class, 'riepilogoQuest'])->name('lab.riepQuest');
Route::post('/pdf', [QuestionariController::class, 'passoPDF'])->name('lab.genpdf');
Route::get('/visualizzaquestionari', [QuestionariController::class, 'visualizzaQuestionari'])->name('lab.visualizzaquest');

//Utente
Route::post('/cercalab', [MapController::class, 'cercaCitta'])->name('map.citta');
Route::get('/gpslab', [VisteController::class, 'gpsMap'])->name('map.gps');

//Utente prenotazioni
Route::get('/prenotazioniSuccess', [VisteController::class, 'pagSuccess'])->name('pagamento.Successo');
Route::post('creaprenotazione', [PrenotazioniController::class,'verificaPrenotazioni'])->name('ut.creapren');

//Utente Visualizza Prenotazioni
Route::get('/prenotazioniUtente', [PrenotazioniController::class, 'visualizzaPrenotazioni'])->name('ut.visualizzaprenotazioni');
Route::get('delete/{NroPre}', [prenotazioniController::class,'annullaPrenotazione'])->name('prenotazioni.delete');
Route::get('/VisualizzaPrenotazione/{NroPre}', [prenotazioniController::class,'visualizzaPrenotazione'])->name('ut.VisualizzaPrenotazione');
Route::get('dat/VisualizzaPrenotazione/{NroPre}', [prenotazioniController::class,'visualizzaPrenotazioneDat'])->name('dat.VisualizzaPrenotazione');

//Utente Esito Tampone
Route::get('/EsitoTampone', [EsitoTamponiController::class,'visualizzaEsitoUtenti'])->name('ut.Esito');


//medico medicina generale
Route::get('/prenotazioni', [MediciController::class, 'visualizzaPrenotazioniMedico'])->name('med.visualizzaprenotazioni');
//cominicazione esiti esterni
Route::get('/ComunicazioneEsitiMedico', [EsitoTamponiController::class,'ComunicazioneEsitiMed'])->name('med.ComunicazioneEsiti');
Route::get('/EsitiLabEsterni', [EsitiTampNonController::class,'retEsitiEsterni'])->name('med.EsitoEsterno');
Route::get('/formeesitosterno', [VisteController::class,'CompilaEsitiEsterniMed'])->name('med.comunicaesitiesterni');
Route::post('/saveEsitoEsterno', [EsitiTampNonController::class,'saveEsitoEsterno'])->name('med.saveEsitoEsterno');
//visualizzazione esiti assistiti
Route::get('/EsitiTamponeAssistiti', [EsitoTamponiController::class,'visualizzaEsitoAssistiti'])->name('med.Esito');
Route::get('med/VisualizzaPrenotazione/{NroPre}', [prenotazioniController::class,'visualizzaPrenotazioneMed'])->name('med.VisualizzaPrenotazione');
Route::get('med/delete/{NroPre}', [prenotazioniController::class,'cancellaPrenotazioneMed'])->name('med.deleteprenotazione');

//Datore
Route::get('/riepilogopren', [PrenotazioniController::class, 'riepPrenDatore'])->name('datore.riepilogopren');
Route::get('dat/annulla/{NroPre}', [prenotazioniController::class,'annullaPrenotazioneDat'])->name('prenotazioni.deleteDat');
Route::get('datvisualizzaprenotazioni', [prenotazioniController::class,'visualizzaprenDatore'])->name('datore.visualPren');
Route::get('dat/visualizzaesiti', [EsitoTamponiController::class,'visualizzaesitiDatore'])->name('datore.visualEsiti');
Route::get('dat/delete/{NroPre}', [prenotazioniController::class,'cancellaPrenotazioneDat'])->name('dat.deleteprenotazione');

//Amministratore di sistema
Route::get('/homeadmin', [VisteController::class, 'homead'])->name('home.admin');

//Amministratore di sistema approva MEDICO
Route::get('/approvadatore', [SpecialUserController::class, 'approvaDatore'])->name('ad.appDatore');
Route::get('/approvamedico', [SpecialUserController::class, 'approvaMedico'])->name('ad.appMedico');
Route::get('/approvaconvenzioni', [SpecialUserController::class, 'approvaConvenzioni'])->name('ad.appconvenziona');

//Amministratore di sistema approva CONVENZIONE
Route::post('ad/lab/confermaconvenzione', [LabController::class, 'setLatLng'])->name('ad.setLatLng');
Route::get('ad/lab/cancellaconvenzione/{id}', [LabController::class, 'deleteRichiesta'])->name('ad.deleteRichiesta');

//Amministratore di sistema approva DATORE
Route::get('ad/dat/approvaconvenzione/{id}', [DatoriController::class, 'accettaDatore'])->name('ad.accDat');
Route::get('ad/dat/cancellaconvenzione/{id}', [DatoriController::class, 'deleteDatore'])->name('ad.deleteDat');

//Amministratore di sistema approva MEDICO
Route::get('ad/med/approvaconvenzione/{id}', [MediciController::class, 'accettaMedico'])->name('ad.accMed');
Route::get('ad/med/cancellaconvenzione/{id}', [MediciController::class, 'deleteMedico'])->name('ad.deleteMed');

//ASL
Route::get('/homeasl', [VisteController::class, 'homeasl'])->name('home.asl');
Route::get('/visualizzaesitipositivi', [EsitoTamponiController::class, 'visualizzaEsitiPositiviAsl'])->name('asl.visualizzaEsitiPositiviAsl');
Route::get('/visualizzanumerotamponi', [EsitoTamponiController::class,'visualizzaNumeroTamponi'])->name('asl.NumeroTamponi');

Route::get('/pagamento', function () {
 return view('pagamento');
})->name('pagamento');





