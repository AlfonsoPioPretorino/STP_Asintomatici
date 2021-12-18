@extends('layouts.app')


	
@section('content') 


<link rel="stylesheet" href="/css/main.css">

g@extends('layouts.app')


	
@section('content') 


<link rel="stylesheet" href="/css/main.css">


  <div id="menu">
    <ul>
    <li id="hm"><a href="{{route('home.admin')}}">← Torna alla home</a></li>
        <li id="hm"><a   href="{{route('ad.appconvenziona')}}">Approva Convenzioni</a></li>
        <li id="hm"><a   href="{{route('ad.appDatore')}}">Approva Datori di Lavoro</a></li>
        <li id="hm"><a  style="color:#766ec5;"  href="{{route('ut.Esito')}}"><u>Approva Medici Medicina Generale</u></a></li>

    <ul>
</div>

<div id="distacco">
<h1 align="center" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;"> Elenco Medici da Approvare</h1>
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
              <th>Nome</th>
              <th>Cognome</th>
              <th>Codice Fiscale</th>
              <th>ALS Appartenenza</th>
              <th>Email</th>
              <th>Numero Cellulare</th>
              <th>Città</th>
              <th>Indirizzo</th>
              <th>Conferma Richiesta</th>
              <th>Annulla Richiesta</th>
              
              
            </tr>
          <thead>
    <tbody>
    
    
      @foreach($infop as $infop)
    <tr>
    
      <td>{{$infop->nome}}</td>
      <td>{{$infop->cognome}}</td>
      <td>{{$infop->codicefiscale}}</td>
      <td>{{$infop->ASLappartenenza}}</td>
      <td>{{$infop->email}}</td>
      <td>{{$infop->numerocellulare}}</td>
      <td>{{$infop->citta}}</td>
      <td>{{$infop->indirizzo}}</td>
      <input type="hidden" name="idlab" value="{{$infop->id}}">
      <td><button type="submit"  id="condizioni2" onclick="window.location='{{ URL::route('ad.accMed', [$infop -> id])}}'"><img  height="25" width="25" src="/img/yes.png"></button></td></td>
      <td><button type="button"  id="condizioni2" onclick="window.location='{{ URL::route('ad.deleteMed', [$infop -> id])}}'"><img  height="25" width="25" src="/img/no.png"></button></td></td>
      
    </tr>
      @endforeach
    </tbody>
        </table>
        
        <div id="distacco"> 
          
          <p><u>Verifica che il Medico appartenga all'albo dei Medici dell'ASL di Appartenenza!</u></p>
          
         
         </div>

  </div>



@endsection 