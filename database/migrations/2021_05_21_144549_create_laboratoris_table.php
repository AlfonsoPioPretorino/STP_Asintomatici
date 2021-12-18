<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaboratorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboratoris', function (Blueprint $table) {
            $table->id();
            $table->text('nomelab');
            $table->text('email');
            $table->integer('numerocellulare');
            $table->text('regione');
            $table->text('provincia');
            $table->text('citta');
            $table->text('indirizzo');
            $table->text('password');
            $table->text('lat');
            $table->text('lng');
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
        Schema::dropIfExists('laboratoris');
    }
}
