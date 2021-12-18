@extends('layouts.app')


	
@section('content') 




<head>
    <link rel="stylesheet" href="/css/main.css">
</head>

<div id="menu">
    <ul>

        <li id="hm"><a href="{{route('lab.homelab')}}">← Torna alla home</a></li>
        <li id="hm"><a href="{{route('lab.visualizzaPrenotazioni')}}">Visualizza Prenotazioni</a></li>
        <li id="hm"><a style="color:#766ec5; " href="{{route('lab.visualizzaquest')}}"><u>Questionario Anamnesi</u></a></li>
        <li id="hm"><a  href="{{route('lab.modificacalendario', ['LoggedUserInfo']) }}">Modifica Calendario</a></li>
        <li id="hm"><a href="{{route('lab.ComunicazioneEsiti')}}">Comunica Esiti Tampone</a></li>
        

    <ul>
</div>

<div>
  <h1 align="center" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">QUESTIONARIO COVID-19</h2>
</div>
  
<form action="{{ route('lab.riepQuest') }}" method="post">

      @if(Session::get('success'))
              <div class="alert alert-success">
                  {{ Session::get('success') }}
              </div>
            @endif

            @if(Session::get('fail'))
              <div class="alert alert-danger">
                  {{ Session::get('fail') }}
              </div>
            @endif

            @csrf
       

<div><div>

<p>Data questionario: <input type="text" name="data" id="input"  onclick="this.value = (new Date()).getDate() + '/' + ((new Date()).getMonth() + 1) + '/' + (new Date()).getFullYear();">
<p>Nro.Prenotazione:<input id="input" type="text" name="nropre" required></p>
<br/></p>
<p><b>DATI  PERSONALI <br/></b>Cognome:<input id="input" type="text" name="cognome">     Nome:<input id ="input" type="text" name="nome"><br/>Data di nascita:<input id="inputp" name="dataNascita" type="date"> Codice Fiscale: <input type="text" id="input" name="codicefiscale"   minlength="16" maxlength="16"/> <br/>Numero di telefono:<input type="text"  id="input" name="numrocellulare"  minlength="10" maxlength="10"/>Indirizzo di residenza:<input type="text" name="indirizzo" id="input" /><br/></p>

<p><b>ANAMNESI LAVORATIVA <br/></b>Mansione attuale:<input id="input" type="text" name="mansione">   Dipartimento:<input id="input" type="text" name="dipartimento">   Sede:<input id="input" type="text" name="sede">    <br/></p>

<p><b>ANAMNESI PATOLOGICA PROSSIMA nelle ultime 48 ore </b><i>(spuntare le risposte)<b></b></i></br>

<label class="checkbox-inline">
            <input type="checkbox" id="febbre" name="febbre" value="febbre">
        <label for="vehicle1"> Febbre (T&#176; &gt; 37,5)</label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="dispnea" name="dispnea" value="dispnea">
        <label for="vehicle1"> Dispnea</label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="Tosse" name="Tosse" value="Tosse">
        <label for="vehicle1"> Tosse </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="Mialgie" name="Mialgie" value="Mialgie">
        <label for="vehicle1"> Mialgie diffuse </label><br>
</label>
<br>

<label class="checkbox-inline">
            <input type="checkbox" id="gusto" name="guesto" value="guesto">
        <label for="vehicle1">Perdita del gusto</label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="diarrea" name="diarrea" value="diarrea">
        <label for="vehicle1">Diarrea </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="olfatto" name="olfatto" value="olfatto">
        <label for="vehicle1">Perdita dell&#8217;olfatto </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="congiuntivite" name="congiuntivite" value="congiuntivite">
        <label for="vehicle1">Congiuntivite monolaterale </label><br>
        </label>
<br>
<label class="checkbox-inline">
        <input type="checkbox" id="Emottisi" name="Emottisi" value="Emottisi">
        <label for="vehicle1"> Emottisi </label><br>
</label>


<label class="checkbox-inline">
            <input type="checkbox" id="congestione" name="congestione" value="congestione">
        <label for="vehicle1">Congestione nasale</label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="eruzioni" name="eruzioni" value="eruzioni">
        <label for="vehicle1">Eruzioni cutanee </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="faringodinia" name="faringodinia" value="faringodinia">
        <label for="vehicle1">Faringodinia</label><br>
        </label>

<br/>Ha effettuato viaggi negli ultimi 14 giorni :
<br>
<label class="checkbox-inline">
    <input type="checkbox" id="no" name="viaggioNo" value="no">
        <label for="vehicle1">NO</label><br>
</label>
<label class="checkbox-inline">
    <input type="checkbox" id="si" name="viaggioSi" value="si">
        <label for="vehicle1">SI</label><br>
</label>
<br>  
<div style="margin-top:-5%;">dove:<input id="input" type="text" name="dove"><div>
        

<br/>Ha eseguito il tampone nasofaringeo :
<br>
<label class="checkbox-inline">
<input type="checkbox" id="no" name="nasofaringeoNo" value="no">
        <label for="vehicle1">NO</label>
</label>
<label class="checkbox-inline">
            <input type="checkbox" id="si" name="nasofaringeoSi" value="si">
        <label for="vehicle1">SI</label>
</label>
</br>
(data ultimo tampone eseguito)<br><input id="inputp" name="datatampone" type="date">esito:<input id="input" type="text" name="esito">

<div id="distacco"></div>
<p><b>ANAMNESI PATOLOGICA REMOTA</b> <br/>

<label class="checkbox-inline">
            <input type="checkbox" id="Asma" name="Asma" value="Asma">
        <label for="vehicle1"> Asma </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="Ipertensione" name="Ipertensione" value="Ipertensione">
        <label for="vehicle1"> Ipertensione arteriosa</label><br>
        </label>

<label class="checkbox-inline">
            <input type="checkbox" id=" Aritmie" name="Aritmie" value=" Aritmie">
        <label for="vehicle1"> Aritmie cardiache </label><br>
</label>

<label class="checkbox-inline">
            <input type="checkbox" id="Scompenso" name="Scompenso" value="Scompenso">
        <label for="vehicle1">Scompenso cardiaco </label><br>
        </label>
</br>
<label class="checkbox-inline">
            <input type="checkbox" id="Malattie" name="Malattie" value="Malattie">
        <label for="vehicle1">Malattie vascolari </label><br>
        </label>
<label class="checkbox-inline">
        <input type="checkbox" id="Neoplasie" name="Neoplasie" value="Neoplasie">
        <label for="vehicle1"> Neoplasie in atto </label><br>
</label>

<label class="checkbox-inline">
            <input type="checkbox" id="Patologia" name="Patologia" value="Patologia">
        <label for="vehicle1">Patologia renale cronica  </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="Epatopatia" name="Epatopatia" value="Epatopatia">
        <label for="vehicle1">Epatopatia cronica</label><br>
        </label>
<label class="checkbox-inline">
    <input type="checkbox" id="PatologieA" name="PatologieA" value="PatologieA">
        <label for="vehicle1"> Patologie autoimmunitarie </label><br>
</label>
<br>
<label class="checkbox-inline">
            <input type="checkbox" id="PatologiaS" name="PatologiaS" value="PatologiaS">
        <label for="vehicle1">Patologia splenica cronica </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="PatologieN" name="PatologieN" value="PatologieN">
        <label for="vehicle1">Patologie neurologiche</label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="Cardiopatia" name="Cardiopatia" value="Cardiopatia">
        <label for="vehicle1">Cardiopatia ischemica </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="Diabete" name="Diabete" value="Diabete">
        <label for="vehicle1">Diabete mellico </label><br>
        </label></br>
        
        
Altro:<input id="input" type="text" name="altroA"></br></br>


Assume farmaci:</br>
<label class="checkbox-inline">
<input type="checkbox" id="no" name="farmaciNo" value="no">
        <label for="vehicle1">NO</label>
</label>
<label class="checkbox-inline">
            <input type="checkbox" id="si" name="farmaciSi" value="si">
        <label for="vehicle1">SI</label>
</label>
</br>
quali:<input id="input" type="text" name="farmacielenco">



<p><b>VALUTAZIONE DEL RISCHIO DI CONTATTO CON  CASO CONFERMATO DI COVID 19 <br/></b></p>

<p><b>Tipologia di contatto</b>
</br>
<label class="checkbox-inline">
            <input type="checkbox" id="lavorativo" name="tipcontlavorativo" value="lavorativo">
        <label for="vehicle1">lavorativo </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="familiare" name="tipcontfamiliare" value="familiare">
        <label for="vehicle1">familiare </label><br>
        </label>
        
        
Altro:<input id="input" type="text" name="altroV"></br>


<p><b>Descrizione del contatto  </b>
<br>
<label class="checkbox-inline">
            <input type="checkbox" id="spazi" name="spazio" value="spazi">
        <label for="vehicle1">condivisione spazi  </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="oggettic" name="oggettic" value="oggettic">
        <label for="vehicle1">contatto con oggetti contaminati </label><br>
</label>
<br>
<label class="checkbox-inline">
            <input type="checkbox" id="igenici" name="igenici" value="igenici">
        <label for="vehicle1">utilizzo servizi igienici comune   </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="trasporto" name="trasporto" value="trasporto">
        <label for="vehicle1">utilizzo comune mezzi di trasporto </label><br>
        </label>
        
        
Altro:<input id="input" type="text" name="altroV"></br>

<p><b>Ambiente in cui &#232; avvenuto il contatto (specificare)<input id="input" type="text" name="specificare"></br></b> <br/></p>
<p>Chiuso:
<br>
<label class="checkbox-inline">
            <input type="checkbox" id="area" name="area510" value="area">
        <label for="vehicle1">Area 5-10 m2 </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="area" name="area1125" value="area">
        <label for="vehicle1">Area 11-25 m2  </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="area" name="area26" value="area">
        <label for="vehicle1">Area 26 m2 - 60 m2    </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="area" name="area60" value="area">
        <label for="vehicle1">Area &#8805; 60 m2 </label><br>
        </label>
<br/> 
Aperto (specificare)<input id="input" type="text" name="aperto"></br>

<p><b>Ventilazione ambiente:</b>
<label class="checkbox-inline">
            <input type="checkbox" id="naturale" name="ventNaturale" value="naturale">
        <label for="vehicle1">Naturale  </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="area_condizionata" name="ventAreaCond" value="area_condizionata">
        <label for="vehicle1">Aria Condizionata </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="mista" name="ventMista" value="mista">
        <label for="vehicle1">Mista</label><br>
        </label>
</p>

</div></div>
<div style="page-break-before:always; page-break-after:always"><div>
<p><b>Distanza dal caso confermato:</b>
<label class="checkbox-inline">
            <input type="checkbox" id="area_condizionata" name="minugu" value="area_condizionata">
        <label for="vehicle1"> &#8804;2m </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="distanza" name="minmag" value="distanza">
        <label for="vehicle1"> &#8805; 2m </label><br>
        </label>
</p>
<p><b>Uso della mascherina:</b> 
<label class="checkbox-inline">
            <input type="checkbox" id="area_condizionata" name="ffp2" value="area_condizionata">
        <label for="vehicle1"> FFP2 </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="distanza" name="chirurgica" value="distanza">
        <label for="vehicle1"> Chirurgica  </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="distanza" name="tessuto" value="distanza">
        <label for="vehicle1">  In tessuto </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="distanza" name="sempre" value="distanza">
        <label for="vehicle1">  In modo continuo  </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="distanza" name="discontinuo" value="distanza">
        <label for="vehicle1"> In modo discontinuo  </label><br>
        </label>

<p><b>Tempi di contatto con il caso confermato nell&#8217;arco delle 24 ore <br/></b></p>

<p>Data ultimo contatto con il caso confermato:<input id="inputp" name="dataultimocontatto" type="date"> </br></p>

<p>Tempo di contatto &#8805; 15 minuti (Numero dei singoli contatti <input id="input" type="text" name="numerosingcont1">)<b> <br/></b>Tempo di contatto &#8804; 15 minuti (Numero dei singoli contatti <input id="input" type="text" name="numerosingcont2">) <br/></p>
<p><b>Sintomi del caso confermato con cui &#232; avvenuto il contatto <br/></b>
<label class="checkbox-inline">
            <input type="checkbox" id="febbre" name="febbrec" value="febbre">
        <label for="vehicle1"> Febbre (T&#176; &gt; 37,5)</label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="dispnea" name="dispneac" value="dispnea">
        <label for="vehicle1"> Dispnea</label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="Tosse" name="Tossec" value="Tosse">
        <label for="vehicle1"> Tosse </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="Mialgie" name="Mialgiec" value="Mialgie">
        <label for="vehicle1"> Mialgie diffuse </label><br>
</label>
<br>
<label class="checkbox-inline">
            <input type="checkbox" id="gusto" name="guestoc" value="guesto">
        <label for="vehicle1">Perdita del gusto</label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="diarrea" name="diarreac" value="diarrea">
        <label for="vehicle1">Diarrea </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="olfatto" name="olfattoc" value="olfatto">
        <label for="vehicle1">Perdita dell&#8217;olfatto </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="congiuntivite" name="congiuntivitec" value="congiuntivite">
        <label for="vehicle1">Congiuntivite monolaterale </label><br>
        </label>
<br>
<label class="checkbox-inline">
        <input type="checkbox" id="Emottisi" name="Emottisic" value="Emottisi">
        <label for="vehicle1"> Emottisi </label><br>
</label>
 

<label class="checkbox-inline">
            <input type="checkbox" id="congestione" name="congestionec" value="congestione">
        <label for="vehicle1">Congestione nasale</label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="eruzioni" name="eruzionic" value="eruzioni">
        <label for="vehicle1">Eruzioni cutanee </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="faringodinia" name="faringodiniac" value="faringodinia">
        <label for="vehicle1">Faringodinia</label><br>
        </label>
<br>

<p><b>Uso della mascherina del caso confermato  <br/></b>
<label class="checkbox-inline">
            <input type="checkbox" id="area_condizionata" name="ffp2c" value="area_condizionata">
        <label for="vehicle1"> FFP2 </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="distanza" name="chirurgicac" value="chirurgica">
        <label for="vehicle1"> Chirurgica  </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="distanza" name="intessutoc" value="in tessuto">
        <label for="vehicle1">  In tessuto </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="distanza" name="continuoc" value="continuo">
        <label for="vehicle1">  In modo continuo  </label><br>
        </label>
<label class="checkbox-inline">
            <input type="checkbox" id="distanza" name="discontinuoc" value="discontinuo">
        <label for="vehicle1"> In modo discontinuo  </label><br>
        </label>

</div></div>

<input type="checkbox" name="firma" required><p>Accetto i termini e le condizioni e sottoscrivo il questionario</p>
<button id ="bg" type=”submit”>Riepilogo Questionario</button>

</form>






@endsection 