@extends('layouts.app')


	
@section('content') 


<link rel="stylesheet" href="/css/main.css">


  <div id="menu">
    <ul>
        <li id="hm"><a href="{{route('home.admin')}}">← Torna alla home</a></li>
        <li id="hm"><a style="color:#766ec5;"  href="{{route('ad.appconvenziona')}}"><u>Approva Convenzioni</u></a></li>
        <li id="hm"><a    href="{{route('ad.appDatore')}}">Approva Datori di Lavoro</a></li>
        <li id="hm"><a    href="{{route('ad.appMedico')}}">Approva Medici Medicina Generale</a></li>

    <ul>
</div>

<div id="distacco">
<h1 align="center" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;"> Elenco Laboratori da Approvare</h1>
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
              <th>Nome Laboratorio</th>
              <th>Email</th>
              <th>Numero Cellulare</th>
              <th>Città</th>
              <th>Indirizzo</th>
              <th>Inserire Latitudine</th>
              <th>Inserire Longitudine</th>
              <th>Conferma Convenzione</th>
              <th>Annulla Convenzione</th>
              
              
            </tr>
          <thead>
    <tbody>
    
    
      @foreach($infop as $infop)
    <tr>
    
      <td>{{$infop->nome}}</td>
      <td>{{$infop->email}}</td>
      <td>{{$infop->numerocellulare}}</td>
      <td>{{$infop->citta}}</td>
      <td>{{$infop->indirizzo}}</td>
      <form action="{{route('ad.setLatLng')}}" method="POST">
        @csrf
            <input type="hidden" name="idlab" value="{{$infop->id}}">
            <td><input type="text" class="form-control" name="latitudine" placeholder="Inserisci latitudine" value="{{ old('latitudine') }}"></td>
            <td><input type="text" class="form-control" name="longitudine" placeholder="Inserisci longitudine" value="{{ old('longitudine') }}"></td>
            <td><button type="submit"  id="condizioni2"><img  height="25" width="25" src="/img/yes.png"></button></td></td>
            <td><button type="button"  id="condizioni2" onclick="window.location='{{ URL::route('ad.deleteRichiesta', [$infop -> id])}}'"><img  height="25" width="25" src="/img/no.png"></button></td></td>

        </form>
      

    
      
      
      
    </tr>
      @endforeach
    </tbody>
        </table>
        
        <div id="distacco"> 
          <a href="https://www.latlong.net/convert-address-to-lat-long.html" target="_blank"><h3><u>www.latlong.net</u></h3></a>
          <p>clicca il link qui sopra e inserisci l'indirizzo e città del laboratorio d'Analisi così da ottenere le coordinate geografiche di quest'ultimo!</p>
          
         
         </div>

  </div>



@endsection 