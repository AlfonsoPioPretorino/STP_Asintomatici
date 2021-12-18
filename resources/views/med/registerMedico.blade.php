<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    
</head>
<body>

   <br>
   <br>
   <br>

   <a href="{{route('home')}}"><img src="/img/Logo piccolo resized.png" class="rounded mx-auto d-block" style="width: 250; height: auto"></a>

   <div class="container" align="center">
      <div class="ro" style="margin-top:45px">
         <div class="col-md-4 col-md-offset-4">
              <h4>| Registrazione Medico Medicina Generale| </h4><hr>
         </div>
      </div>
   </div>
   <div class="container">
      <form action="{{ route('med.save') }}" method="post">
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
  
             @csrf
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
               <input type="date" class="form-Control" name="data" value="{{ old('data') }}" required>
            </div> 
         </div>
         <div class="col">
            <label>Numero cellulare</label>
            <input type="text" class="form-control" name="numerocellulare" placeholder="Inserisci numero cellulare" value="{{ old('numerocellulare') }}">
            <span class="text-danger">@error('numerocellulare'){{ $message }} @enderror</span>
         </div>
         <div class="col">
            <label>Regione</label>
                   <select class="form-control" name="regione" id="regione" required>
                       <option value="">Seleziona regione</option>
                       <option value="Abruzzo">Abruzzo</option>
                       <option value="Basilicata">Basilicata</option>
                       <option value="Calabria">Calabria</option>
                       <option value="Campania">Campania</option>
                       <option value="Emilia-Romagna">Emilia-Romagna</option>
                       <option value="Friuli Venezia Giulia">Friuli Venezia Giulia</option>
                       <option value="Lazio">Lazio</option>
                       <option value="Liguria">Liguria</option>
                       <option value="Lombardia">Lombardia</option>
                       <option value="Marche">Marche</option>
                       <option value="Molise">Molise</option>
                       <option value="Piemonte">Piemonte</option>
                       <option value="Puglia">Puglia</option>
                       <option value="Sardegna">Sardegna</option>
                       <option value="Sicilia">Sicilia</option>
                       <option value="Toscana">Trentino</option>
                       <option value="Trentino-Alto-Adige">Trentino-Alto-Adige</option>
                       <option value="Umbria">Umbria</option>
                       <option value="Valle d Aosta">Valle d Aosta</option>
                       <option value="Veneto">Veneto</option>
                   </select>
         </div>
         <div class="w-100"></div>
         <div class="col">
            <div class="form-group">
               <label>Provincia</label>
               <input type="text" class="form-control" name="provincia" placeholder="Inserisci Provincia" value="{{ old('provincia') }}">
               <span class="text-danger">@error('provincia'){{ $message }} @enderror</span>
            </div>
         </div>
         <div class="col">
            <label>Citta'</label>
            <input type="text" class="form-control" name="citta" placeholder="Inserisci citta'" value="{{ old('citta') }}">
            <span class="text-danger">@error('citta'){{ $message }} @enderror</span>
         </div>
         <div class="w-100"></div>
         <div class="col">
            <div class="form-group">
               <label>Indirizzo</label>
               <input type="text" class="form-control" name="indirizzo" placeholder="Inserisci indirizzo" value="{{ old('indirizzo') }}">
               <span class="text-danger">@error('indirizzo'){{ $message }} @enderror</span>
            </div> 
         </div>
         <div class="col">
          <div class="form-group">
              <label>ASL di appartenenza</label>
              <input type="text" class="form-control" name="asl" placeholder="Inserisci partita IVA" value="{{ old('PartitaIva') }}">
              <span class="text-danger">@error('partitaIva'){{ $message }} @enderror</span>
           </div>
         </div>
         <div class="col">
            <label>Password</label>
            <input type="password" class="form-control" name="password" placeholder="Inserisci password">
            <span class="text-danger">@error('password'){{ $message }} @enderror</span>
         </div>
         <div class="w-100"></div>
      </div>
      <br>
      <button type="submit" style = "align: center"class="btn btn-block btn-primary">Invia Richiesta</button>
   </form>
   </div>
   
   <div class="container" align="center">
      <div class="ro" style="margin-top:45px">
         <div class="col-md-4 col-md-offset-4">
              
                 <a href="{{ route('auth.login') }}">Hai già un accout ? Accedi !</a>
              
         </div>
      </div>
   </div>
    
</body>
</html>