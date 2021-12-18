
         
  @extends('layouts.app')


	
  @section('content') 
  
  
  <link rel="stylesheet" href="/css/main.css">
  
  <div id="menu">
      <ul>
      <li id="hm"><a href="{{route('home.asl')}}">← Torna alla home</a></li>
          <li id="hm"><a  href="{{route('asl.NumeroTamponi')}}">Visualizza Numero Tamponi</a></li>
          <li id="hm"><a style="color:#766ec5;" href="{{route('asl.visualizzaEsitiPositiviAsl')}}"><u>Visualizza Utenti Positivi Covid-19</u></a></li>
      <ul>
  </div>
  
  <div id="distacco">
    <h1 align="center" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">Elenco esiti positivi</h2>
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


  <div class="container">
      <div class="row">
        <div class="col">
          <h3>Esiti positivi di utenti registrati</h3>
          <table border="1">
            <thead>
                    <tr>
                      <th>Nome</th>
                      <th>Cognome</th>
                      <th>Email</th>
                      <th>Numero Cellulare</th>
                      <th>Indirizzo</th>
                      <th>Esito</th>
                      <th>Tipologia Tampone</th>
                    </tr>
                  <thead>
            <tbody>
            
            
              @foreach($infop as $infop)
            <tr>
              <td>{{$infop->nome}}</td>
              <td>{{$infop->cognome}}</td>  
              <td>{{$infop->email}}</td>
              <td>{{$infop->numerocellulare}}</td>
              <td>{{$infop->indirizzo}}</td>
              <td>{{$infop->Esito}}</td>
              <td>{{$infop->TipologiaTampone}}</td>
            </tr>
              @endforeach
            </tbody>
          </table>
                
              <blockquote> Responsive Table </blockquote>
        </div>

          <div class="col">
            <h3>Esiti aggiunti dai medici di medicina generale <br> di laboratori non convenzionati</h3>
            <table border="1">
              <thead>
                      <tr>
                        <th>Nome Medico</th>
                        <th>Cognome Medico</th>
                        <th>Email</th>
                        <th>Numero Cellulare</th>
                        <th>ASL appartenenza</th>
                        <th>Indirizzo</th>
                        <th>Id Tampone</th>
                        <th>Esito</th>
                        <th>Tipologia Tampone</th>
                      </tr>
                    <thead>
              <tbody>
              
              
                @foreach($infoNC as $infoNC)
              <tr>
                <td>{{$infoNC->nome}}</td>
                <td>{{$infoNC->cognome}}</td>  
                <td>{{$infoNC->email}}</td>
                <td>{{$infoNC->numerocellulare}}</td>
                <td>{{$infoNC->ASLappartenenza}}</td>
                <td>{{$infoNC->indirizzo}}</td>
                <td>{{$infoNC->idesito}}</td>
                <td>{{$infoNC->esito}}</td>
                <td>{{$infoNC->TipTamp}}</td>
              </tr>
                @endforeach
              </tbody>
            </table>
                  
                <blockquote>  </blockquote>
          </div>
      </div>
  </div>
</div>
  
 
  
  @endsection 