
	
@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="public/css/main.css">

<div>
<h1 align="center" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">Benvenuto sulla Home Page</h1>
</div>

<body>
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
	<div id="bottonimenu2">

		<button type="button" id="pulsante"  onclick="window.location='{{ URL::route('med.visualizzaprenotazioni')}}'">Genera Ricevuta Prenotazione</button></td>
		<button type="button" id="pulsante"  onclick="window.location='{{ URL::route('med.EsitoEsterno')}}'">Comunica esiti da lab non convenzionati</button>	
		<button type="button" id="pulsante"  onclick="window.location='{{ URL::route('med.Esito')}}'">Visualizza Esiti Tampone Assistiti</button>
	
		
	</div>



	<div>
<h1 align="center">Ricerca laboratori</h1>
</div>

<div id="form">
	<form action="{{ route('map.citta') }}" method="POST">
		@csrf
		<input style="width: 60%;" type="text" name= "citta" placeholder="Inserisci nome città" size="30" maxlength="200" /><br>
		<button id ="bg" type=”submit”>Cerca Laboratorio</button>oppure
		<button type="button" id="bg"  onclick="window.location='{{ URL::route('map.gps') }}'">Geolocalizzami</button></td>
	</form>
</div>

</div>


	

</body>






@endsection

