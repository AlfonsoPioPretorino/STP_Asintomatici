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


<h1 id="distacco"> Riepilogo Calendario Disponibilità Lab</h1>

<form action="{{ route('lab.saveCalendario', $prov) }}" method="post" >

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
<div align="center">    
  <input id="id" name="id" type="hidden" value="{{ $LoggedUserInfo->id }}">    
    <h4><b>◇ Giorni lavorativi inseriti:</b></h4>
      @foreach ($prov->giorniSett as $item)
        <li>{{$item}}</li>
      @endforeach



  <h4><b>◇ Fascia Oraria in cui effettuare Tamponi inserita</b></h4>


      <p>Mattina dalle ore: {{$prov->orarioMin}} alle ore: {{$prov->orarioMout}}</p>
      <p>Pomeriggio dalle ore: {{$prov->orarioPin}} alle ore: {{$prov->orarioPout}}</p>


  
  
  <h4><b>◇ Tipologia tamponi disponibili:</b></h4>

      @foreach ($prov->tipologiaTamp as $item)
      
      @if($item=='molecolare')
        <li>{{$item}} (prezzo: 60,00€)</li>  
        @endif
      
      @if($item=='sierologico')
        <li>{{$item}} (prezzo: 30,00€)</li>  
        @endif

      @if($item=='antigenico')
        <li>{{$item}} (prezzo: 20,00€)</li>  
        @endif 
      @endforeach

  <button id ="bg" type=”submit”>Salva Calendario</button>  <button type="button" id="bg"  onclick="window.location='{{ URL::route('lab.modificacalendario') }}'">Annulla</button></td>
</div> 
  




@endsection





