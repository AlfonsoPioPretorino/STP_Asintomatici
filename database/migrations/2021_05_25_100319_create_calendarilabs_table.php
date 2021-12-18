<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarilabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendarilab', function (Blueprint $table) {
            $table->id();
            $table->foreign('id')->references('id')->on('laboratori')->onDelete('cascade');
            $table->json('giorniSett');
            $table->time('orarioMin');
            $table->time('orarioMout');
            $table->time('orarioPin');
            $table->time('orarioPout');
            $table->json('tipologiTamp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendarilab');
    }
}
