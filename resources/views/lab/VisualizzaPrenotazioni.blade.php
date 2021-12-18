
         
  @extends('layouts.app')


	
  @section('content') 
  
  
  <link rel="stylesheet" href="/css/main.css">
  
  <div id="menu">
      <ul>
      <li id="hm"><a href="{{route('lab.homelab')}}">← Torna alla home</a></li>
          <li id="hm"><a style="color:#766ec5;" href="{{route('lab.visualizzaPrenotazioni')}}"><u>Visualizza Prenotazioni</u></a></li>
          <li id="hm"><a href="{{route('lab.visualizzaquest')}}">Questionario Anamnesi</a></li>
          <li id="hm"><a   href="{{route('lab.modificacalendario', ['LoggedUserInfo']) }}">Calendario Disponibilità</a></li>
          <li id="hm"><a  href="{{route('lab.ComunicazioneEsiti')}}">Comunica Esiti Tampone</a></li>
      <ul>
  </div>
  
  <div id="distacco">
    <h1 align="center" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">Elenco Prenotazioni Laboratorio</h2>
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
                <th>Nome Utente</th>
                <th>Cognome Utente</th>
                <th>Codice fiscale Utente</th>
                
                <th>Tipologia Tampone</th>
                <th>Prezzo</th>
                
                
                <th>Tipo di pagamento</th>
                <th>Esito Tampone</th>
                
              </tr>
            <thead>
      <tbody>
      
      
        @foreach($infop as $infop)
      <tr>
      
        <td>{{$infop->NroPren}}</td>
        <td>{{$infop->Data}}</td>
        <td>{{$infop->Orario}}</td>
        <td>{{$infop->nome}}</td>
        <td>{{$infop->cognome}}</td>
        <td>{{$infop->codicefiscale}}</td>
        
        <td>{{$infop->TipologiaTampone}}</td>
        <td>{{$infop->Prezzo}}€</td>
        
        <td> {{$infop->Pagamento}}</td>
        @if ($infop->Esito == 'da definire')
            <td>{{$infop->Esito}}*</td>
            @else
            <td>{{$infop->Esito}}</td>
        @endif
        
  
      
        
        
        
      </tr>
        @endforeach
      </tbody>
      </table>
          
        <blockquote> Responsive Table </blockquote>
    
  <p style="color: red">* esito non ancora comunicato al paziente</p>
    </div>
  
 
  
  @endsection 