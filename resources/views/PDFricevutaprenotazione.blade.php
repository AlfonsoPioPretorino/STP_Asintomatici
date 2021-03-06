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
    <h2 class="sotto">{{$infodat->nome}} - {{$infodat->indirizzo}} - {{$infodat->citta}} - {{$infodat->numerocellulare}} - {{$infodat->nomeattivit}}</h2>
    <hr class="line"><br>
    <pre>Nro. Prenotazione: {{$nropre->NroPren}}</pre><br>
    <div class="sez">
        <p>Il datore {{$infodat->nome}} {{$infodat->cognome}} ha prenotato un tampone {{$infotamp->Tipologia}} per il/la singor/a {{$infout->nome}} {{$infout->cognome}} nato/a il {{$infout->datadinascita}}, con codice fiscale {{$infout->codicefiscale}}.</p>
        <p>Il/La prenotato/a dovr?? presentarsi il giorno {{$nropre->Data}} in ora {{$nropre->Orario}} presso il laboratorio {{$infolab->nome}} in {{$infolab->indirizzo}} ({{$infolab->citta}}).</p>
        <p>Il servizio ?? offerto al costo di {{$infotamp->Prezzo}}??? per il tampone prenotato/a.</p>
    </div>
    <br>
    <br>
    <br>
    <p class="b" style="text-align: right">Firma del datore di lavoro</p>
    <br>
    <p style="text-align: right">{{$infodat->nome}} {{$infodat->cognome}}</p>
</head>
<body>
    
</body>
