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
    <h2 class="sotto">{{$LoggedUserInfo->nome}} - {{$LoggedUserInfo->indirizzo}} - {{$LoggedUserInfo->citta}} - {{$LoggedUserInfo->numerocellulare}}</h2>
    <hr class="line">
</head>
<body>
    <pre>Data questionario: {{$questionario->data}}                                                                                 Nro. Prenotazione: {{$questionario->nropre}}</pre><br>
    <div class="sez">
        <p class="b">Dati Personali <br>
            <pre>Cognome: {{$questionario->cognome}}        Nome: {{$questionario->nome}}        Data di nascita: {{$questionario->dataNascita}}</pre><br class="p">
            <pre>Codice Fiscale: {{$questionario->codicefiscale}}        Numero di telefono: {{$questionario->numerocellulare}}</pre><br class="p">
            <pre>Indirizzo di residenza: {{$questionario->indirizzo}}</pre><br class="p">
        </p>
        <br>
        <p class="b">Anamnesi Laborativa
            <pre>Mansione attuale: {{$questionario->mansione}}  Dipartimento: {{$questionario->dipartimento}}   Sede: {{$questionario->sede}}</pre><br class="p">
        </p>
        <br>
        <p class="b">Anamnesi patologica prossima nelle ultime 48 ore <br>
            <div class="el">
                <p>
                    @if (!($questionario->febbre == NULL))
                        • Febbre 
                    @endif

                    @if (!($questionario->dispnea == NULL))
                        • Dispnea
                    @endif

                    @if (!($questionario->Tosse == NULL))
                        • Tosse
                    @endif

                    @if (!($questionario->Mialgie == NULL))
                        • Mialgie diffuse
                    @endif

                    @if (!($questionario->guesto == NULL))
                        • Perdita del gusto
                    @endif

                    @if (!($questionario->diarrea == NULL))
                        • Diarrea
                    @endif
                </p>
                <p>
                    @if (!($questionario->olfatto == NULL))
                        • Perdita olfatto
                    @endif
                    
                    @if (!($questionario->congiuntivite == NULL))
                        • Congiuntivite
                    @endif
                    
                    @if (!($questionario->Emottisi == NULL))
                        • Emottisi
                    @endif
                    
                    @if (!($questionario->congestione == NULL))
                        • Congestione nasale
                    @endif

                    @if (!($questionario->eruzioni == NULL))
                        • Eruzioni cutanee
                    @endif
                    
                    @if (!($questionario->faringodinina == NULL))
                        • Faringodinia
                    @endif
                </p>
            </div>
        </p>
        <p>Ha effettuato viaggi negli ultimi 14 giorni?
            @if (!($questionario->viaggioNo == NULL))
                No
            @endif
            @if (!($questionario->viaggioSi == NULL))
                Si, in {{$questionario->dove}}
            @endif
        </p>
        <p>
            Ha eseguito il tampone nasofaringeo?
            @if (!($questionario->nasofaringeoNo == NULL))
                No
            @endif
            @if (!($questionario->nasofaringeoSi == NULL))
                Si, con esito {{$questionario->esito}} il giorno {{$questionario->datatampone}}
            @endif
        </p>
        <br>
        <p class="b">Anamnesi patologia remota</p>
        <div class="el">
            <p>
                @if (!($questionario->Asma) == NULL)
                    • Asma
                @endif
                @if (!($questionario->Ipertensione) == NULL)
                    • Ipretensione arteriosa
                @endif
                @if (!($questionario->Aritmie) == NULL)
                    • Aritmie cardiache
                @endif
                @if (!($questionario->Scompenso) == NULL)
                    • Scompenso cardiaco
                @endif
                @if (!($questionario->Malattie) == NULL)
                    • Malattie vascolari
                @endif
                </p>
                <p>
                @if (!($questionario->Neoplasie) == NULL)
                    • Neoplasie in atto
                @endif
                @if (!($questionario->Patologia) == NULL)
                    • Patologia renale cronica
                @endif
                @if (!($questionario->Epatopatia) == NULL)
                    • Epatopatia cronica
                @endif
                @if (!($questionario->PatologieA) == NULL)
                    •  Patologie autoimmunitarie
                @endif
                </p>
                <p>
                @if (!($questionario->PatologiaS) == NULL)
                    • Patologia splenica cronica
                @endif
                @if (!($questionario->Cardiopatia) == NULL)
                    • Cardiopatia ischemica
                @endif
                @if (!($questionario->Diabete) == NULL)
                    • Diabete mellico
                @endif
            </p>
        </div>
        <p>Altro: {{$questionario->altroA}}</p>
        <p>Assume farmaci
            @if (!($questionario->farmaciNo) == NULL)
                No
            @endif
            @if (!($questionario->farmaciSi) == NULL)
                si
                {{$questionario->farmacielenco}}
            @endif
        </p>
        <br>
        <p class="b">Valutazione del rischio di contatto con caso confermato di COVID-19</p><br>
        <div class="el">
            <p>Tipologia contatto:
                @if (!($questionario->tipocontlavorativo) == NULL)
                    Lavorativo
                @endif
                @if (!($questionario->tipocontfamiliare) == NULL)
                    Familiare
                @endif
                @if (!($questionario->altroV) == NULL)
                    {{$questionario->altroV}}
                @endif
            </p>
            <p>Descrizione del contatto:
                @if (!($questionario->spazio) == NULL)
                    • Condivisione spazi
                @endif
                @if (!($questionario->oggettic) == NULL)
                    • Contatto con oggetti contaminati
                @endif
                </p>
                <p>
                @if (!($questionario->igenici) == NULL)
                    • Utilizzo servizi igenici comune
                @endif
                @if (!($questionario->trasporto) == NULL)
                    • Utilizzo comune mezzi di trasporto
                @endif
                @if (!($questionario->altroV) == NULL)
                    <p>Altro:{{$questionario->altroV}}</p>
                @endif
            </p>
                 @if (!($questionario->specificare) == NULL)
                    <p>Ambiente in cui è avvenuto il contatto (specificare):</p>
                    <p>{{$questionario->altroV}}</p>
                @endif

                <p>Chiuso
                    @if (!($questionario->area510) == NULL)
                    • Area 5-10 m2
                    @endif
                    @if (!($questionario->area1125) == NULL)
                    • Area 11-25 m2
                    @endif
                    @if (!($questionario->area26) == NULL)
                    • Area 26 m2 - 60m2
                    @endif
                    @if (!($questionario->area60) == NULL)
                    • Area > 60 m2
                    @endif
                    @if (!($questionario->aperto) == NULL)
                    <p>Aperto: {{$questionario->aperto}}</p>
                    @endif
                </p>


                <p>Ventilazione ambiente:
                    @if (!($questionario->ventNaturale) == NULL)
                        • Naturale
                    @endif
                    @if (!($questionario->ventAreaCond) == NULL)
                        • Area Condizionata
                    @endif
                    @if (!($questionario->centMista) == NULL)
                        • Mista
                    @endif
                </p>

                <p>Distanza dal caso confermato:
                    @if (!($questionario->minugu) == NULL)
                        • <= 2m
                    @endif
                    @if (!($questionario->minmah) == NULL)
                        • >= 2m
                    @endif
                </p>

                <p>Uso della mascherina:
                    @if (!($questionario->ffp2) == NULL)
                        • FFP2
                    @endif
                    @if (!($questionario->chirurgica) == NULL)
                        • Chirurgica
                    @endif
                    @if (!($questionario->tessuto) == NULL)
                        • In tessuto
                    @endif
                    @if (!($questionario->sempre) == NULL)
                        • In modo continuo
                    @endif
                    @if (!($questionario->discontinuo) == NULL)
                        • In modo discontinuo
                    @endif
                </p>
        </div>

        <p class="b">Tempo di contatto con il caso confermato nell'arco delle 25 ore</p>
        <p>Data ultimo contatto con il caso confermato:</p>
        <p>{{$questionario->dataultimocontatto}}</p>
        <p>Tempo di contatto maggiore di 15 minuti (Numero singoli contatti: {{$questionario->numerosingcont1}}).</p>
        <p>Tempo di contatto minore di 15 minuti (Numero singoli contatti: {{$questionario->numerosingcont2}}).</p>

        <p class="b">Sintomi del caso confermato con cui è avvenuto il contatto</p>
        <div class="el">
            @if (!($questionario->febbrec)==NULL)
                • Febbre
            @endif
            @if (!($questionario->dispneac)==NULL)
                • Dispnea
            @endif
            @if (!($questionario->Tossec)==NULL)
                • Tosse
            @endif
            @if (!($questionario->Mialgiec)==NULL)
                • Mialgie diffuse
            @endif
            @if (!($questionario->gustoc)==NULL)
                • Perdita del gusto
            @endif
            @if (!($questionario->diarreav)==NULL)
                • Diarrea
            @endif
            @if (!($questionario->olfattoc)==NULL)
                • Perdita dell'olfatto
            @endif
        </p>
        <p>
            @if (!($questionario->congiuntivitec)==NULL)
                • Congiuntivite monolaterale
            @endif
            @if (!($questionario->Emottisic)==NULL)
                • Emottisi
            @endif
            @if (!($questionario->congestionec)==NULL)
                • Congestione nasale
            @endif
            @if (!($questionario->eruzionic)==NULL)
                • Eruzioni cutanee
            @endif
            @if (!($questionario->Faringodiniac)==NULL)
                • Faringodinia
            @endif
        </div>
        <p class="b">Uso della mascherina del caso confermato</p>
        <div class="el">
            @if (!($questionario->ffp2c) == NULL)
                • FFP2
            @endif
            @if (!($questionario->chirurgicac) == NULL)
                • Chirurgica
            @endif
            @if (!($questionario->tessutoc) == NULL)
                • In tessuto
            @endif
            @if (!($questionario->semprec) == NULL)
                • In modo continuo
            @endif
            @if (!($questionario->discontinuoc) == NULL)
                • In modo discontinuo
            @endif
        </div>
       
    </div>
    
    <br>
    <br>
    <br>
    <p class="b" style="text-align: right">Firma del paziente</p>
    <br>
    <p style="text-align: right">{{$infout->nome}} {{$infout->cognome}}</p>

</body>
<script type="text/php">
    if ( isset($pdf) ) {
        $font = Font_Metrics::get_font("helvetica", "bold");
        $pdf->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));
    }
</script> 