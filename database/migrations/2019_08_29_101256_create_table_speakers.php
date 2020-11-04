<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSpeakers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_speakers', function (Blueprint $table) {
            $table->bigIncrements('id');
            

            $table->string('bio', 100)->default('');
            $table->text('description')->default('');
            $table->string('image', 100)->default('');

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
        Schema::dropIfExists('table_speakers');
    }
}
