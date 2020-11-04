<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('location', 100)->default('');

            $table->unsignedBigInteger('venue_id');

            $table->foreign('venue_id')
                ->references('id')->on('table_venues')
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
        Schema::dropIfExists('table_locations');
    }
}
