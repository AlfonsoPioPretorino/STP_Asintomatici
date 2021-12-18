@extends('layouts.app')


	
@section('content') 


  <head>
    <link rel="stylesheet" href="/css/main.css">
  </head>


<body>
  <div id="menu">
      <ul>

        @if (session()->has('LoggedUser'))
            <li id="hm"><a href="{{route('home.utente')}}">← Torna alla home</a></li>
          @else
            <li id="hm"><a href="{{route('home')}}">← Torna alla home</a></li>
        @endif
          
      <ul>
  </div>

  <div class="text-center"  >
    <h3 id="distacco">Calendario Laboratorio</h3>
    @foreach ($cal->giorniSett as $giorni)
      <b><p>{{$giorni}}</p></b>
      <div class="text-center" style="margin: 16px">
        <li>Mattina:    {{$cal->orarioMin}} - {{$cal->orarioMout}}</li>
        <li>Pomeriggio: {{$cal->orarioPin}} - {{$cal->orarioPout}}</li>
      </div>
    @endforeach

    <b><p>Tipologia tamponi:</p></b>

    @foreach ($cal->tipologiaTamp as $tipo)
      @if ($tipo == 'molecolare')
          <div class="text-center" style="margin: 8px">
            <li>{{$tipo}} prezzo: 60,00€</li>
          </div> 
      @endif
      @if ($tipo == 'sierologico')
      
        <div class="text-center" style="margin: 8px">
          <li>{{$tipo}} prezzo: 30,00€</li>
        </div> 
     @endif
      @if ($tipo == 'antigenico')
        <div class="text-center" style="margin: 8px">
          <li>{{$tipo}} prezzo: 20,00€</li>
        </div> 
      @endif 
    @endforeach
  </div>
</body>






@endsection 