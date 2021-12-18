@extends('layouts.app')
@section('content')




 
<link rel="stylesheet" href="/css/main.css">

<div id="menu">
    <ul>
        <li id="hm"><a href="{{route('home.datore')}}">← Torna alla home</a></li>
    <ul>
</div>


<h1 id="distacco"> Elenco prenotazioni Tampone</h1>

<div id="distacco">
<table border="1" align="center">
<thead>
        <tr>
          <th>Numero Prenotazione</th>
          <th>Data</th>
          <th>Orario</th>
          <th>laboratorio</th>
          <th>Tipologia Tampone</th>
          <th>Prezzo</th>
          
          <th>Sei sicuro di eliminare la prenotazione?</th>
          
          
        </tr>
      <thead>
<tbody>


 <tr>
 
  <td>{{$infop->NroPren}}</td>
  <td>{{$infop->Data}}</td>
  <td>{{$infop->Orario}}</td>
  <td>{{$infop->nome}}</td>
  <td>{{$infop->TipologiaTampone}}</td>
  <td>{{$infop->Prezzo}}€</td>
  
  <td> <a id="condizioni" href="{{route('med.deleteprenotazione', [$infop -> NroPren]) }}" > Conferma </a>⠀⠀ ||⠀⠀ <a id="condizioni" href="{{route('ut.visualizzaprenotazioni')}}"> Annulla</a></td>
  


  
  
  
 </tr>

</tbody>
</table>
      
    <blockquote> Responsive Table </blockquote>

</div>



@endsection





