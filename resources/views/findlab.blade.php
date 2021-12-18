

@extends('layouts.app')
@section('content') 

<link rel="stylesheet" href="css/main.css">


<div>
	<h1 align="center" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">Sistema di prenotazioni COVID-19</h2>
</div>

<head>

	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
	integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
	crossorigin=""/>


 <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin="">
</script>

</head>

<body id>
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

	<div align="center">
	<div id="labMap"></div>
	</div>
	<div align="left" style="margin: 60px">
		<p>
			<h2>Come funziona la mappa?</h2>
			<h3>Verranno visualizzate:</h3>
			<ul>
				<li>
					<div id="image" style="display:inline;">
						<img src="img/marker-lab.png" style="width:50px;height: auto;">
					</div>
					<div id="texts" style="display:inline; white-space:nowrap;"> 
						→ Indicano la posizione dei laboratori. Se cliccati mostreranno informazioni e la possiblità di prenotare presso quel laboratorio.
					</div>
				</li>
			</ul>
		</p>
	</div>
	
	


	


	
	<script>

		//Icone Custom
		var labmarker = L.icon({
			iconUrl: '/img/marker-lab.png',
			iconSize:     [38, 38], // size of the icon
			popupAnchor:  [0, -20] // point from which the popup should open relative to the iconAnchor
		});

		//MAPPA
		const labMap = L.map('labMap').setView([{{$InfoCitta->lat}}, {{$InfoCitta->lng}}], 13);
		const tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		maxZoom: 20,
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1,
		accessToken: 'pk.eyJ1IjoiZnVuemluIiwiYSI6ImNrcGdwbTE4MzA1Y2sycG84MXJtNGJncmcifQ.bWGoo4sGP-ROL97cWANmZg'
		});
		tiles.addTo(labMap);

		function addMarker(lat, lng, nome, indirizzo, citta, id)
			{
				//Metodo che rest id laboratorio selezionato
				var url = '{{ route("disp.lab", ":id") }}';
				url = url.replace(':id', id);
				var cal = '{{ route("map.calendario", ":id") }}';
				cal = cal.replace(':id', id);

				var latlng = L.latLng(lat, lng);
				L.marker([lat, lng], {icon: labmarker}).addTo(labMap).bindPopup('<div align = "center"><h5>'+nome+'</h5><br><h6>'+citta+'</h6><h6>'+indirizzo+'</h6> @if(session('Attore') == 'medico')<a href="'+url+'">Prenota tampone assistito</a><br>o<br>@endif @if(session('Attore') == 'datore')<a href="'+url+'">Prenota tampone dipendenti</a><br>o<br>@endif @if(session('Attore') == 'utente')<a href="'+url+'">Prenota tampone</a><br>o<br>@endif<a href="'+cal+'">Visualizza Calendario</a> </div>');
		
			}



		//API LABORATORI
		async function getLab(){
			const lab_url = '/api/laboratori';
			const response = await fetch(lab_url);
			const data = await response.json();
			console.log(data);

			var trovato = 0;
			

			for(var i = 0; i < data.length; i++) 
			{
				var obj = data[i];

				if(obj.citta == '{{$InfoCitta->comune}}')
				{
					addMarker(obj.latitudine, obj.longitudine, obj.nome, obj.indirizzo, obj.citta, obj.id);
					trovato++;
				}
			}

			if(trovato == 0)
			{
				showAlert();
			}
		}


		//Codice per allert
		async function showAlert() 
		{
    		alert ("Nessun laboratorio convenzionato trovato in questo comune!");
  		}

		//Nascondi Pulsante
		function showHide(divId) {
    	$("#"+divId).toggle();
		}

		getLab();
	</script>

	
	

    

</body>






@endsection