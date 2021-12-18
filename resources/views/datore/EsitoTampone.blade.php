@extends('layouts.app')
@section('content')




 
<link rel="stylesheet" href="/css/main.css">

<div id="menu">
    <ul>
    <li id="hm"><a href="{{route('home.datore')}}">← Torna alla home</a></li>
        <li id="hm"><a  href="{{route('datore.visualPren')}}">Visualizza Prenotazioni Tamponi Dipendenti</a></li>
        <li id="hm"><a style="color:#766ec5;"   href="{{route('datore.visualEsiti')}}"><u>Visualizza Esiti Tamponi Dipendenti</u></a></li>
    <ul>
</div>


<div id="distacco">
<h1 align="center" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;"> Elenco Esiti Tampone Dipendenti</h1>
</div>

<div id="distacco">
<table border="1" align="center">
<thead>
        <tr>
          <th>IdUtente</th>
          <th>Numero Prenotazione</th>
          <th>Data </th>
          <th>Tipologia Tampone </th>
          <th>Esito Tampone</th>
          
          
          
        </tr>
      <thead>
<tbody>


  @foreach($infop as $infop)
 <tr>
 
  <td>{{$infop->IdUtente}}</td>
  <td>{{$infop->NroPre}}</td>
  <td>{{$infop->Data}}</td>
  <td>{{$infop->TipologiaTampone}}</td>
  
  @if ($infop->Esito == 'da definire')
            <td>{{$infop->Esito}}*</td>
            @else
            <td>{{$infop->Esito}}</td>
        @endif
  
  
  
 </tr>
  @endforeach
</tbody>
</table>
      
<p id="distacco" style="color: red">* esito non ancora comunicato al dipendente</p>
  

</div>



@endsection





