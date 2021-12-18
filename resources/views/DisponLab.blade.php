@extends('layouts.app')


	
@section('content') 


  <head>
    <link rel="stylesheet" href="/css/main.css">
  </head>



  <div id="menu">
      <ul>
          @if (session('Attore') == 'utente')
          <li id="hm"><a href="{{route('home.utente')}}">← Torna alla home</a></li>
            @endif
            @if (session('Attore') == 'datore')
            <li id="hm"><a href="{{route('home.datore')}}">← Torna alla home</a></li>  
            @endif
            @if (session('Attore') == 'med')
            <li id="hm"><a href="{{route('home.medico')}}">← Torna alla home</a></li>
            @endif
            @if (session('Attore') == 'lab')
            <li id="hm"><a href="{{route('lab.homelab')}}">← Torna alla home</a></li>
            @endif    
            @if(!session()->has('Attore'))
            <li id="hm"><a href="{{route('home')}}">← Torna alla home</a></li>
            @endif
          
      <ul>
  </div>
<div>
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
  <div class="checkbox-inline" style="margin: 8px; border-style:solid; border-color:#050505; border-width:1px; width: 20%;">
  
    <h3>Calendario Laboratorio</h3>
    @foreach ($cal->giorniSett as $giorni)
      <p>{{$giorni}}</p>
      <div class="text-lef" style="margin: 16px">
        <li>Mattina:    {{$cal->orarioMin}} - {{$cal->orarioMout}}</li>
        <li>Pomeriggio: {{$cal->orarioPin}} - {{$cal->orarioPout}}</li>
      </div>
    @endforeach

    <p>Tipologia tamponi:</p>

    @foreach ($cal->tipologiaTamp as $tipo)
      @if ($tipo == 'molecolare')
          <div class="text-lef" style="margin: 8px">
            <li>{{$tipo}} prezzo: 60,00€</li>
          </div> 
      @endif
      @if ($tipo == 'sierologico')
      
        <div class="text-lef" style="margin: 8px">
          <li>{{$tipo}} prezzo: 30,00€</li>
        </div> 
     @endif
      @if ($tipo == 'antigenico')
        <div class="text-lef" style="margin: 8px">
          <li>{{$tipo}} prezzo: 20,00€</li>
        </div> 
      @endif
      
    @endforeach
    
  </div>

 @if(session('Attore') == 'utente')
  <div class="container">
      <form action="{{ route('ut.creapren') }}" method="post">
        
        @csrf
        <input type="hidden" name="id" value="{{$cal->id}}">
        <input type="hidden" name="idut" value="{{$LoggedUserInfo->id}}">
        <div class="form-group">
          <label for="data">Prenota in data:</label>
          <input type="date" class="form-Control" name="data" value="{{ old('data') }}" required>
        </div>
        <div class="form-group">
          <label for="orario"> e ora:</label>
          <p><b>N.B.</b> (Inserire orario del tipo: 13:00, 13:15, 13:30, 13:45)</p>
          <input type="time" id="appt" name="orario" step="900"  required>
        </div>
        <label>Tipologia Tampone</label>
        <select class="form-control" name="tiptamp" id="tiptamp"  required>
            <option value="">Seleziona tipologia</option>
            <option value="molecolare">Molecolare (60,00€) </option>
            <option value="antigenico">Antigenico (20,00€)</option>
            <option value="sierologico">Sierologico (30,00€)</option>
        </select>
        <label>Vuoi pagare:</label>
        <select class="form-control" name="tippag" id="tippag" required>
          <option value="">Seleziona metodo pagamento</option>
          <option value="Laboratorio">In laboratorio</option>
          <option value="Online">Online</option>
          
        </select>
        <br>
        <button type="submit" class="btn btn-block btn-primary" id="prenota">Prenota</button>
        <br>
    </form>
  </div>
@endif

@if(session('Attore') == 'medico')
<div class="container">
      <form action="{{ route('ut.creapren') }}" method="post">
      <div class="container" align="center">
   <div class="ro" style="margin-top:45px">
      <div class="col-md-4 col-md-offset-4">
           <h4>| Inserire dati Assistito | </h4><hr>
      </div>
   </div>
</div>
<div class="container">
   <form action="{{ route('auth.save') }}" method="post">
      @csrf 
   <div class="row">
     <div class="col">
         <label>Nome</label>
         <input type="text" class="form-control" name="nome" placeholder="Inserisci nome" value="{{ old('nome') }}">
         <span class="text-danger">@error('nome'){{ $message }} @enderror</span>
     </div>
     <div class="col">
      <div class="form-group">
         <label>Cognome</label>
         <input type="text" class="form-control" name="cognome" placeholder="Inserisci cognome" value="{{ old('cognome') }}">
         <span class="text-danger">@error('cognome'){{ $message }} @enderror</span>
      </div>
     </div>
     <div class="w-100"></div>
     <div class="col">
        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" name="email" placeholder="Inserisci e-mail" value="{{ old('email') }}">
            <span class="text-danger">@error('email'){{ $message }} @enderror</span>
        </div> 
      </div>
      <div class="col">
         <label>Codice fiscale</label>
         <input type="text" class="form-control" name="codicefiscale" placeholder="Inserisci codice fiscale" value="{{ old('codicefiscale') }}">
         <span class="text-danger">@error('codicefiscale'){{ $message }} @enderror</span>
      </div>
      <div class="w-100"></div>
      <div class="col">
         <div class="form-group">
            <label for="data">Data di nascita</label>
            <input type="date" class="form-Control" name="datadinascita" value="{{ old('data') }}" required>
         </div> 
      </div>
      <div class="col">
         <label>Numero cellulare</label>
         <input type="text" class="form-control" name="numerocellulare" placeholder="Inserisci numero cellulare" value="{{ old('numerocellulare') }}">
         <span class="text-danger">@error('numerocellulare'){{ $message }} @enderror</span>
      </div>
      <div class="w-100"></div>
   </div>
   <br>

   <div class="ro" style="margin-top:45px">
    <div class="container" align="center">
    <div class="col-md-4 col-md-offset-4">
         <h4>Inserire preferenze prenotazione</h4><hr>
    </div>
    </div>
   </div>
        <input type="hidden" name="id" value="{{$cal->id}}">
        <input type="hidden" name="iddoc" value="{{$LoggedUserInfo->id}}">
        <div class="form-group">
          <label for="data">Prenota in data:</label>
          <input type="date" class="form-Control" name="data" value="{{ old('data') }}" required>
        </div>
        <div class="form-group">
          <label for="orario"> e ora:</label>
          <p><b>N.B.</b> (Inserire orario del tipo: 13:00, 13:15, 13:30, 13:45)</p>
          <input type="time" id="appt" name="orario" step="900"  required>
        </div>
        <label>Tipologia Tampone</label>
        <select class="form-control" name="tiptamp" id="tiptamp"  required>
            <option value="">Seleziona tipologia</option>
            <option value="molecolare">Molecolare</option>
            <option value="antigenico">Antigenico</option>
            <option value="sierologico">Sierologico</option>
        </select>
        <br>
        <button type="submit" class="btn btn-block btn-primary" id="prenota">Prenota</button>
        <br>
    </form>
  </div>


@endif
@if(session('Attore') == 'datore')
<div class="container">
      <form action="{{ route('ut.creapren') }}" method="post">
      <div class="container" align="center">
   <div class="ro" style="margin-top:45px">
      <div class="col-md-4 col-md-offset-4">
           <h4>| Inserire dati dipendente | </h4><hr>
      </div>
   </div>
</div>
<div class="container">
   <form action="{{ route('auth.save') }}" method="post">
      @csrf 
   <div class="row">
     <div class="col">
         <label>Nome</label>
         <input type="text" class="form-control" name="nome" placeholder="Inserisci nome" value="{{ old('nome') }}">
         <span class="text-danger">@error('nome'){{ $message }} @enderror</span>
     </div>
     <div class="col">
      <div class="form-group">
         <label>Cognome</label>
         <input type="text" class="form-control" name="cognome" placeholder="Inserisci cognome" value="{{ old('cognome') }}">
         <span class="text-danger">@error('cognome'){{ $message }} @enderror</span>
      </div>
     </div>
     <div class="w-100"></div>
     <div class="col">
        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" name="email" placeholder="Inserisci e-mail" value="{{ old('email') }}">
            <span class="text-danger">@error('email'){{ $message }} @enderror</span>
        </div> 
      </div>
      <div class="col">
         <label>Codice fiscale</label>
         <input type="text" class="form-control" name="codicefiscale" placeholder="Inserisci codice fiscale" value="{{ old('codicefiscale') }}">
         <span class="text-danger">@error('codicefiscale'){{ $message }} @enderror</span>
      </div>
      <div class="w-100"></div>
      <div class="col">
         <div class="form-group">
            <label for="data">Data di nascita</label>
            <input type="date" class="form-Control" name="datadinascita" value="{{ old('data') }}" required>
         </div> 
      </div>
      <div class="col">
         <label>Numero cellulare</label>
         <input type="text" class="form-control" name="numerocellulare" placeholder="Inserisci numero cellulare" value="{{ old('numerocellulare') }}">
         <span class="text-danger">@error('numerocellulare'){{ $message }} @enderror</span>
      </div>
      <div class="w-100"></div>
   </div>
   <br>

   <div class="ro" style="margin-top:45px">
    <div class="container" align="center">
    <div class="col-md-4 col-md-offset-4">
         <h4>Inserire preferenze prenotazione</h4><hr>
    </div>
    </div>
   </div>
        <input type="hidden" name="id" value="{{$cal->id}}">
        <input type="hidden" name="iddoc" value="{{$LoggedUserInfo->id}}">
        <div class="form-group">
          <label for="data">Prenota in data:</label>
          <input type="date" class="form-Control" name="data" value="{{ old('data') }}" required>
        </div>
        <div class="form-group">
          <label for="orario"> e ora:</label>
          <p><b>N.B.</b> (Inserire orario del tipo: 13:00, 13:15, 13:30, 13:45)</p>
          <input type="time" id="appt" name="orario" step="900"  required>
        </div>
        <label>Tipologia Tampone</label>
        <select class="form-control" name="tiptamp" id="tiptamp"  required>
            <option value="">Seleziona tipologia</option>
            <option value="molecolare">Molecolare</option>
            <option value="antigenico">Antigenico</option>
            <option value="sierologico">Sierologico</option>
        </select>
        <br>
        <button type="submit" class="btn btn-block btn-primary" id="prenota">Prenotazione Successiva</button>
        <br>
    </form>
    @if (session('Npren')>0)
      <p>o</p>
      <br>
      <button type="submit" class="btn btn-block btn-primary" onclick="window.location='{{ URL::route('pagamento')}}'">Riepiloga e paga</button>
    @endif
        
  </div>


@endif



</div>




@endsection 