@extends('layouts.app')
@section('content')

<style type="text/css">



</style>


 
<link rel="stylesheet" href="/css/main.css">

<div id="menu">
    <ul>

        <li id="hm"><a href="{{route('lab.homelab')}}">← Torna alla home</a></li>
        
        

    <ul>
</div>


<h1 id="distacco"> Calendario Disponibilità Lab</h1>

<div id="distacco">
<table border="1" align="center">
<thead>
        <tr>
          <th>Id Laboratorio</th>
          <th>Giorni disponibilità</th>
          <th>Mattina Dalle</th>
          <th>Alle </th>
          <th>Pomeriggio Dalle</th>
          <th>Alle</th>
          
          <th>Tipologia Tampone Disponibile</th>
          
          
        </tr>
      <thead>
<tbody>


  @foreach($infop as $infop)
 <tr>
 
  <td>{{$infop->id}}</td>
  <td>{{$infop->giorniSett}}</td>
  <td>{{$infop->orarioMin }}</td>
  <td>{{$infop->orarioMout }}</td>
  <td>{{$infop->orarioPin }}</td>
  <td>{{$infop->orarioPout }}</td>
  <td>{{$infop->tipologiaTamp}}</td>
  
  

  
  
  
 </tr>
  @endforeach
</tbody>
</table>
      
    <blockquote> Responsive Table </blockquote>

</div>





@endsection





