
@extends('layouts.app')

	
@section('content')

<link rel="stylesheet" href="public/css/main.css">

<div>
<h1 align="center" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">Benvenuto sulla Home Page</h1>
</div>


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

<div id="bottonimenu"> 
<button id="pulsante" onclick="window.location='{{ URL::route('asl.NumeroTamponi')}}'" >Visualizza Numero Tamponi</button>
<button id="pulsante" onclick="window.location='{{ URL::route('asl.visualizzaEsitiPositiviAsl')}}'">Visualizza Utenti Positivi Covid-19</button>
</div>






@endsection