 @extends('layouts.app')


	
@section('content') 


<link rel="stylesheet" href="/css/main.css">




<div id="menu">
    <ul>

        <li id="hm"><a href="{{route('lab.homelab')}}">← Torna alla home</a></li>
        <li id="hm"><a href="{{route('lab.visualizzaPrenotazioni')}}">Visualizza Prenotazioni</a></li>
        <li id="hm"><a href="{{route('lab.visualizzaquest')}}"> Questionario Anamnesi</a></li>
        <li id="hm"><a style="color:#766ec5; " href="{{route('lab.modificacalendario')}}"><u>Calendario Disponibilità</u></a></li>
        <li id="hm"><a href="{{route('lab.ComunicazioneEsiti')}}">Comunica Esiti Tampone</a></li>
        

    <ul>
</div>

<div id="distacco">
  <h1 align="center" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">Modifica Calendario Laboratorio</h2>
</div>


  <form action="{{ route('lab.riepilogoCalendario') }}" method="post" >

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
    <div class="container">    
    <input id="id" name="id" type="hidden" value="{{ $LoggedUserInfo->id }}">    
    <p align="left" class="bootstrap-demo"><b>◇ Selezionare giorni lavorativi:</b>
      <div  align="left">
        <label class="checkbox-inline">
          <input class="checkbox-inline" type="checkbox" id="lun" name="giorniSett[]" value="lunedi">Lunedì
          
        </label>

        <label class="checkbox-inline">
            <input type="checkbox" id="mar" name="giorniSett[]" value="martedi">Martedì
        </label>

        <label class="checkbox-inline">
            <input type="checkbox" id="mer" name="giorniSett[]" value="mercoledi">Mercoledì
        </label>

        <label class="checkbox-inline">
            <input type="checkbox" id="gio" name="giorniSett[]" value="giovedi">Giovedì
        </label>
        <label class="checkbox-inline">
          <input type="checkbox" id="ven" name="giorniSett[]" value="venerdi">Venerdì
        </label>

        <label class="checkbox-inline">
          <input type="checkbox" id="sab" name="giorniSett[]" value="sabato">Sabato
        </label>

        <label class="checkbox-inline">
          <input type="checkbox" id="dom" name="giorniSett[]" value="domenica">Domenica
        </label>
      </div>
    </p>

    <p align="left" class="bootstrap-demo"><b>◇ Selezionare Fascia Oraria in cui effettuare Tamponi: N.B. </b>(Inserire orario del tipo: 13:00, 13:15, 13:30, 13:45)</p>

      <div align="left">
      
        Mattina dalle ore:<input type="time" id="appt" name="orarioMin" step="900" required>

        <small>alle ore:</small>
        <input type="time" id="appt" name="orarioMout" step="900" required>
        <br>
        <br>
        Pomeriggio dalle ore:<input type="time" id="appt" name="orarioPin" step="900" required>
          

        <small>alle ore:</small>
        <input type="time" id="appt" name="orarioPout" step="900" required>
      </div>
    </p>
    
      
      
    <p align="left" class="bootstrap-demo"><b>◇ Selezionare tipologia tamponi disponibili:</b>
      <div align="left">
        <label class="checkbox-inline"> <!-- class checkbox-inline to display checkbox inline --><!-- input type checkbox -->
          <input class="checkbox-inline" type="checkbox" id="" name="tipologiaTamp[]" value="molecolare">Molecolare (prezzo: 60,00€)
        </label>

        <label class="checkbox-inline">
            <input type="checkbox" id="" name="tipologiaTamp[]" value="antigenico">Antigenico (prezzo: 20,00€)
        </label>

        <label class="checkbox-inline">
            <input type="checkbox" id="" name="tipologiaTamp[]" value="sierologico">Sierologico (prezzo: 30,00€)
        </label>
      </div>
    </p>
  </div> 
      <button id ="bg" type=”submit”>Salva Calendario</button> <button type="button" id="bg"  onclick="window.location='{{ URL::route('lab.visualizzaCalendario') }}'">Visualizza Calendario</button></td>

  </form>




@endsection 