@extends('layouts.app')


	
@section('content') 


  <head>
    <link rel="stylesheet" href="/css/main.css">
    
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
                font-size: 20px;
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
    
  </head>



  <div id="menu">
      <ul>  
           
      <ul>
  </div>
    <div class="container"> 
        <div class="sez">
            <p class="b">Dati Dipendente <br>
                <pre>Cognome: {{$dip->cognome}}        Nome: {{$dip->nome}}        Data di nascita: {{$dip->datadinascita}}</pre><br class="p">
                <pre>Codice Fiscale: {{$dip->codicefiscale}}        Numero di telefono: {{$dip->numerocellulare}}</pre><br class="p">
                <br class="p">
            </p>
            <p class="b">Dati prenotazione <br>
                <pre>Data esecuzione tampone: {{$prenot->Data}}       Orario: {{$prenot->Orario}}        Tipologia Tampone: {{$prenot->TipologiaTampone}}</pre><br class="p">
                <br class="p">
            </p>
        </div>
        <button id ="bg" type=”submit” onclick="window.location='{{ URL::route('disp.lab', $lab)}}'" >Conferma e continua</button> <button type="button" id="bg"  onclick="window.location='{{ URL::route('prenotazioni.deleteDat', [$prenot->NroPren])}}'">Annulla prenotazione</button></td>
    </div>
       
    
  


@endsection 