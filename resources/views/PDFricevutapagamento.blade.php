<head>
    
    <style>
        h1{
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-size: medium;
            text-align: center;
        }
        h2.sotto{
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-size: small;
            text-align: center;
        }
        .logo{
            width:auto;
            height:60px;
            float: right;
        }
        hr.line {
            border: 1px solid grey;
        }
        p.sez{

        }
        pre{
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        div.sez{
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        p.b{
            font-weight: bold;
            font-style: italic;
            text-align: center;
            font-size: 16px;
        }
        br.p{
            display: block;
            margin-bottom: -.4em;
        }
        div.el{
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            white-space: nowrap;
        }
        
    </style>

    <img src="data:image/png;base64,{{ $logo }}" class="logo"/><br><br><br><br>
    <h1>Sistema di prenotazioni tamponi Asintomatici</h1>
    <h2 class="sotto">{{$infomed->nome}} - {{$infomed->indirizzo}} - {{$infomed->citta}} - {{$infomed->numerocellulare}} - {{$infomed->ASLappartenenza}}</h2>
    <hr class="line"><br>
    <pre>Nro. Prenotazione: {{$nropre->NroPren}}</pre><br>
    <div class="sez">
        <p>Il paziente {{$infout->nome}} {{$infout->cognome}} nato il {{$infout->datadinascita}}, con codice fiscale {{$infout->codicefiscale}} ha prenotato un tampone {{$infotamp->Tipologia}} tramite il medico di medicina generale {{$infomed->nome}} {{$infomed->cognome}}.</p>
        <p>Il paziente dovrà presentarsi il giorno {{$nropre->Data}} in ora {{$nropre->Orario}} presso il laboratorio {{$infolab->nome}} in {{$infolab->indirizzo}} ({{$infolab->citta}}).</p>
        <p>Il servizio è offerto al costo di {{$infotamp->Prezzo}}€ per il tampone prenotato.</p>
    </div>
    <br>
    <br>
    <br>
    <p class="b" style="text-align: right">Firma del medico di medicina generale</p>
    <br>
    <p style="text-align: right">{{$infomed->nome}} {{$infomed->cognome}}</p>
</head>
<body>
    
</body>
