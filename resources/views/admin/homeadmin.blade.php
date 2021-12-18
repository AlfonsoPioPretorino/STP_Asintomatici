
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
<button id="pulsante" onclick="window.location='{{ URL::route('ad.appconvenziona')}}'" >Approva Convenzioni</button>
<button id="pulsante" onclick="window.location='{{ URL::route('ad.appDatore')}}'">Approva Datori di Lavoro</button>
<button type="button" id="pulsante"  onclick="window.location='{{ URL::route('ad.appMedico') }}'">Approva Medici di medicina</button></td>
</div>






@endsection