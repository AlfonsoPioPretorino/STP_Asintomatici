@extends('layouts.app')


	
@section('content') 


<link rel="stylesheet" href="/css/main.css">


  <div id="menu">
    <ul>
    <li id="hm"><a href="{{route('home.admin')}}">← Torna alla home</a></li>
    <li id="hm"><a   href="{{route('ad.appconvenziona')}}">Approva Convenzioni</a></li>
    <li id="hm"><a  style="color:#766ec5;"  href="{{route('ad.appDatore')}}"><u>Approva Datori di Lavoro</u></a></li>
    <li id="hm"><a    href="{{route('ad.appMedico')}}">Approva Medici Medicina Generale</a></li>

    <ul>
</div>

<div id="distacco">
<h1 align="center" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;"> Elenco Datori da Approvare</h1>
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
              <th>Email</th>
              <th>Numero Cellulare</th>
              <th>Partita IVA</th>
              <th>Nome Attività</th>
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
      <td>{{$infop->email}}</td>
      <td>{{$infop->numerocellulare}}</td>
      <td>{{$infop->partitaIVA}}</td>
      <td>{{$infop->nomeattivit}}</td>
      <td>{{$infop->citta}}</td>
      <td>{{$infop->indirizzo}}</td>
      <input type="hidden" name="idlab" value="{{$infop->id}}">
      <td><button type="submit"  id="condizioni2" onclick="window.location='{{ URL::route('ad.accDat', [$infop -> id])}}'"><img  height="25" width="25" src="/img/yes.png"></button></td></td>
      <td><button type="button"  id="condizioni2" onclick="window.location='{{ URL::route('ad.deleteDat', [$infop -> id])}}'"><img  height="25" width="25" src="/img/no.png"></button></td></td>
      
    </tr>
      @endforeach
    </tbody>
        </table>
        
        <a href="https://telematici.agenziaentrate.gov.it/VerificaPIVA/Scegli.do?parameter=verificaPiva" target="_blank"><h3><u>agenziaentrate.gov.it</u></h3></a>
          <p><u>Verificare l'esistenza dell'attività e la validità della partita IVA!</u></p>
        
        
  </div>


  

 

@endsection 