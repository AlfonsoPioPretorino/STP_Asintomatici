@extends('layouts.app')
@section('content')




 
<link rel="stylesheet" href="/css/main.css">



<div id="menu">
    <ul>
    <li id="hm"><a href="{{route('home.medico')}}">← Torna alla home</a></li>
        <li id="hm"><a href="{{route('med.visualizzaprenotazioni')}}">Genera Ricevuta Prenotazione</a></li>
       
        <li id="hm"><a style=" color:#766ec5;" href="{{route('med.EsitoEsterno')}}"><u>Comunica Esiti Tampone Assistiti</u></a></li>
        <li id="hm"><a  href="{{route('med.Esito')}}">Visualizza Esiti Tamponi Assistiti</a></li>
    <ul>
</div>
    <div class="container" align="center">
        <div id="distacco">
            <h1 align="center" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;"> Comunicazione Esiti Tampone</h1>
            <br>
            <br>
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
                <form action="{{ route('med.saveEsitoEsterno') }}" method="POST">
                    @csrf

                    <label>Esito</label>
                    <select class="form-control" name="esito" required>
                        <option value="">Seleziona esito</option>
                        <option value="positivo">Positivo</option>
                        <option value="negativo">Negativo</option>
                    </select>
                    <br>
                    <label>Tipologia Tampone</label>
                    <select class="form-control" name="tiptamp" id="tiptamp"  required>
                        <option value="">Seleziona tipologia</option>
                        <option value="molecolare">Molecolare</option>
                        <option value="antigenico">Antigenico</option>
                        <option value="sierologico">Sierologico</option>
                    </select>
                    <br>
                    <button type="submit" class="btn btn-block btn-primary" id="prenota">Comunica Esito</button>
                    
                </form>
        </div>
    </div>






@endsection





