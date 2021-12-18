@extends('layouts.app')


	
@section('content') 


<link rel="stylesheet" href="/css/main.css">


  <div id="menu">
    <ul>
    <li id="hm"><a href="{{route('home.utente')}}">← Torna alla home</a></li>
        <li id="hm"><a style="color:#766ec5;"  href="{{route('ut.visualizzaprenotazioni')}}"><u>Visualizza Prenotazioni Tamponi</u></a></li>
        <li id="hm"><a    href="{{route('ut.Esito')}}">Visualizza Esiti Tamponi</a></li>
    <ul>
</div>

<div id="distacco">
<h1 align="center" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;"> Elenco Prenotazioni Tampone</h1>
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
              <th>Data</th>
              <th>Orario</th>
              <th>laboratorio</th>
              <th>Tipologia Tampone</th>
              <th>Prezzo</th>
              
              <th>Elimina Prenotazione</th>
              <th>Tipo di pagamento</th>
              
            </tr>
          <thead>
    <tbody>
    
    
      @foreach($infop as $infop)
    <tr>
    
      <td>{{$infop->NroPren}}</td>
      <td>{{$infop->Data}}</td>
      <td>{{$infop->Orario}}</td>
      <td>{{$infop->nome}}</td>
      <td>{{$infop->TipologiaTampone}}</td>
      <td>{{$infop->Prezzo}}€</td>
      <td> <a href="{{ URL::route('ut.VisualizzaPrenotazione', [$infop -> NroPren]) }}"> &#128465;&#65039;</a></td>
      <td> {{$infop->Pagamento}}</td>
      

    
      
      
      
    </tr>
      @endforeach
    </tbody>
</table>
        
      <blockquote> Responsive Table </blockquote>
  

  </div>



@endsection 