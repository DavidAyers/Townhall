<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
           

            $table->string('head', 100)->default('');
            $table->text('content')->default('');
            $table->string('type', 100)->default('');//welcome, notifications

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
        Schema::dropIfExists('table_messages');
    }
}
