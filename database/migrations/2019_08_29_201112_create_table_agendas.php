<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAgendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_agendas', function (Blueprint $table) {
            $table->bigIncrements('id');
            

            $table->string('title', 100)->default('');
            $table->text('description')->default('');
            $table->string('date', 100)->default('');
            $table->string('start_time', 100)->default('');
            $table->string('end_time', 100)->default('');

            $table->unsignedBigInteger('venue_id');
            $table->unsignedBigInteger('location_id');
            
            $table->foreign('venue_id')
                ->references('id')->on('table_venues')
                ->onDelete('cascade');
            $table->foreign('location_id')
                ->references('id')->on('table_locations')
                ->onDelete('cascade');
            
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
        Schema::dropIfExists('table_agendas');
    }
}
