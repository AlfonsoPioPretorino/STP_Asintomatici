<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UtentiAddCogCfNcRPCI extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('utenti', function (Blueprint $table) {
           
            $table->string('cognome')->after('nome');
            $table->string('codicefiscale')->after('cognome');
            $table->integer('numerocellulare')->after('codicefiscale');
            $table->string('regione')->after('numerocellulare');
            $table->string('provincia')->after('regione');
            $table->string('citta')->after('provincia');
            $table->string('indirizzo')->after('citta');
            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('utenti', function (Blueprint $table) {
            //
        });
    }
}
