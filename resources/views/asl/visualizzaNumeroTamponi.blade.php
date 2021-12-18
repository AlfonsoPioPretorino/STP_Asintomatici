@extends('layouts.app')
@section('content')




 
<link rel="stylesheet" href="/css/main.css">

<div id="menu">
    <ul>
    <li id="hm"><a href="{{route('home.asl')}}">← Torna alla home</a></li>
        <li id="hm"><a style="color:#766ec5;"  href="{{route('asl.NumeroTamponi')}}"><u>Visualizza Numero Tamponi</u></a></li>
        <li id="hm"><a    href="{{route('asl.visualizzaEsitiPositiviAsl')}}">Visualizza Utenti Positivi Covid-19</a></li>
    <ul>
</div>


<div id="distacco">
<h1 align="center" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;"> Elenco Numero Tamponi Effettuati</h1>
</div>

<div style="float:left; display:block; width:17%; height:150px;">
</div>

  <div id="distacco" style="float:left; display:block; width:50%; height:150px;">
  <table border="1" align="center">
  <thead>
          <tr>
            <th>Regione</th>
            <th>Data</th>
            <th>Numero Tamponi Positivi</th>

          </tr>
        <thead>
  <tbody>


    @foreach($infop as $infop)
   <tr>
   
    <td>{{$infop->regione}}</td>
    <td>{{$infop->Data}}</td>
    <td>{{$infop->total}}</td> 
 
    
    @endforeach
    
   </tr>
  <tbody> 
  </table>
  </div>




  <div id="distacco" style="float:left; display:block; width:197.5px;">
        
      


      <table border="1" align="center">
        <thead>
                <tr>
                  
                  <th>Numero Tamponi Negativi</th>
                </tr>
              <thead>
        <tbody>
        @foreach($neg as $neg)
        <tr>
        
            <td>{{$neg->totalN}}</td>
        
          
          @endforeach
         </tr>
          
        </tbody>
        </table>
              
            <blockquote></blockquote>
      


  </div>







@endsection
