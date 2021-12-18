@extends('layouts.app')
@section('content')




 
<link rel="stylesheet" href="/css/main.css">



<div id="menu">
    <ul>
    <li id="hm"><a href="{{route('lab.homelab')}}">← Torna alla home</a></li>
        <li id="hm"><a href="{{route('lab.visualizzaPrenotazioni')}}">Visualizza Prenotazioni</a></li>
        <li id="hm"><a href="{{route('lab.visualizzaquest')}}">Questionario Anamnesi</a></li>
        <li id="hm"><a href="{{route('lab.modificacalendario', ['LoggedUserInfo']) }}">Calendario Disponibilità</a></li>
        <li id="hm"><a style=" color:#766ec5;" href="{{route('lab.ComunicazioneEsiti')}}"><u>Comunica Esiti Tampone</u></a></li>
    <ul>
</div>

<h1 id="distacco" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;"> Comunicazione Esiti Tampone</h1>

<div id="distacco">
<table border="1" align="center">
<thead>
        <tr>
          <th>Numero Prenotazione</th>
          
          <th>IdUtente</th>
          <th>Tipologia Tampone</th>
          
          <th>Comunica Esito Tampone</th>
          
          
          
        </tr>
      <thead>
<tbody>


  @foreach($infop as $infop)
 <tr>
 
  <td>{{$infop->NroPren}}</td>
  <td>{{$infop->IdUtente}}</td>
  <td>{{$infop->TipologiaTampone}}</td>
  
  
  <td> <a id="condizioni" href="{{ URL::route('EsitoN', [$infop -> NroPren]) }} " >Negativo </a>⠀⠀ ||⠀⠀ <a id="condizioni" href="{{ URL::route('EsitoP', [$infop -> NroPren]) }}" >Positivo</a></td>

  


  
  
  
 </tr>
  @endforeach
</tbody>
</table>
      
    <blockquote> Responsive Table </blockquote>

</div>



@endsection





