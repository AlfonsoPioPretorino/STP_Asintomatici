@extends('layouts.app')
@section('content')




 
<link rel="stylesheet" href="/css/main.css">



<div id="menu">
    <ul>
    <li id="hm"><a href="{{route('home.medico')}}">← Torna alla home</a></li>
        <li id="hm"><a href="{{route('med.visualizzaprenotazioni')}}">Genera Ricevuta Prenotazione</a></li>
       
        <li id="hm"><a style=" color:#766ec5;" href="{{route('med.EsitoEsterno')}}"><u>Comunica Esiti Tampone Assistiti</u></a></li>
        <li id="hm"><a  href="{{route('med.Esito')}}">Visualizza Esiti Tamponi Assistiti</a></li>
    <ul>
</div>

<div id="distacco">
<h1 align="center" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;"> Comunicazione Esiti Tampone</h1>
<br>
<br>
<button type="button" id="pulsante"  onclick="window.location='{{ URL::route('med.comunicaesitiesterni')}}'">+ Nuovo esito laboratorio non convenzionato</button>

</div>
<div id="distacco">
<table border="1" align="center">
<thead>
        <tr>
          <th>IdEsito</th>
          <th>Tipologia Tampone</th>
        </tr>
      <thead>
<tbody>
  @foreach($infop as $infop)
 <tr>
  <td>{{$infop->id}}</td>
  <td>{{$infop->TipTamp}}</td>
 </tr>
  @endforeach
</tbody>
</table>
      
    <blockquote> Responsive Table </blockquote>

</div>



@endsection





