
         
  @extends('layouts.app')


	
@section('content') 


<link rel="stylesheet" href="/css/main.css">

<div id="menu">
    <ul>
      <li id="hm"><a href="{{route('lab.homelab')}}">← Torna alla home</a></li>
      <li id="hm"><a href="{{route('lab.visualizzaPrenotazioni')}}">Visualizza Prenotazioni</a></li>
      <li id="hm"><a style="color:#766ec5; " href="{{route('lab.visualizzaquest')}}"><u>Questionario Anamnesi</u></a></li>
      <li id="hm"><a  href="{{route('lab.modificacalendario', ['LoggedUserInfo']) }}">Modifica Calendario</a></li>
      <li id="hm"><a href="{{route('lab.ComunicazioneEsiti')}}">Comunica Esiti Tampone</a></li>
    <ul>
</div>

<div id="distacco">
  <h1 align="center" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">Elenco Prenotazioni Laboratorio</h2>
</div>

  <div id="distacco">

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
  <table border="1" align="center">
    <thead>
            <tr>
              <th>Numero Prenotazione</th>
              <th>Nome</th>
              <th>Cognome</th>
              <th>Codice Fiscale</th>
              <th>Documento</th>
            </tr>
          <thead>
    <tbody>
      @foreach($quests as $item)
    <tr>
      <td>{{$item->NroPren}}</td>
      <td>{{$item->nome}}</td>
      <td>{{$item->cognome}}</td>
      <td>{{$item->codicefiscale}}</td>
      <td> <a id="condizioni" href="{{$item->Percorso}}" target="_blank">Visualizza</a>
    </tr>
      @endforeach
    </tbody>
    </table>
        
      <blockquote> Responsive Table </blockquote>

      <pre><button id ="bg" onclick="window.location='{{ URL::route('lab.nuovoQuest') }}'" style="float: center ">+ Nuovo questionario</button>    </pre>
  

  </div>



@endsection 