
	
@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="public/css/main.css">

<div>
<h1 align="center" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">Sistema di prenotazioni COVID-19</h2>
</div>
<body>
	<script src="mix{{'js/app.js'}}"></script>
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

	<div id="tabella">
	<table id="tab">
	
	<tr>
	
	<td id="td"><img src="/img/guida.jpg" height="120px" width="220px" alt=""><br><br><br> Se vuoi conoscere le differenze tra i vari tipi di tampone e per sapere cosa fare prima e dopo aver effettuato il tampone <p><u>Clicca il pulsante qui in basso</u></p>
		<br>
		<button type="button"  id="bg"  onclick=" window.open('/doc/GUIDA.pdf','_blank')">Guida tamponi</button></td>
		
		
		<td id="td"><img src="/img/utente.jpg" height="120px" width="220px" alt=""><br><br><br>Se sei un utente non registrato e vuoi prenotare un tampone utilizzando il nostro sistema <p><u>Clicca il pulsante qui in basso per effettuare la registrazione</u></p>
		<br>	
		<button type="button" id="bg"  onclick="window.location='{{ URL::route('auth.register') }}'">Crea Profilo</button></td>
		
		
		<td id="td"><img src="/img/laboratori.jpg" height="120px" width="220px" alt=""><br><br><br>Se sei un laboratorio d'analisi e vuoi entrar a far parte del nostro sistema, offrendo il tuo servizio di tamponi <p><u>Clicca il pulsante qui in basso per convenzionarti</u></p>
		<br>
		<button type="button" id="bg"  onclick="window.location='{{ URL::route('lab.convenzionati') }}'">Convenzionati</button></td>
		
		<td id="td"><img src="/img/datore.jpg" height="120px" width="220px" alt=""><br><br><br>Se sei un datore di Lavoro e vuoi prenotare un tampone da far effettuare ai propri dipendenti <p><u>Clicca il pulsante qui in basso per effetture la registrazione</u></p>
		<br>
		<button type="button" id="bg"  onclick="window.location='{{ URL::route('datore.register') }}'">Registrati come Datore</button></td>

		
		<td id="td"><img src="/img/medico.jpg" height="120px" width="220px" alt=""><br><br><br>Se sei un medico di medicina generale e vuoi prenotare un tampone per un tuo assistio<p><u>Clicca il pulsante qui in basso per effetture la registrazione</u></p>
		<br>


		<button type="button" id="bg"  onclick="window.location='{{ URL::route('med.register') }}'">Registrati come Medico</button></td>
	</tr>

	</table>
	</div>

				

		<h2>Ricerca laboratori:</h2>

		<div id="form">
			<form action="{{ route('map.citta') }}" method="POST">
				@csrf
				<input type="text" name= "citta" style="width: 60%;" placeholder="Inserisci nome città"/><br>
				<button id ="bg" type=”submit”>Cerca laboratorio</button>oppure
				<button type="button" id="bg"  onclick="window.location='{{ URL::route('map.gps') }}'">Geolocalizzami</button></td>
			</form>
		</div>
	</div>


	

</body>







@endsection

