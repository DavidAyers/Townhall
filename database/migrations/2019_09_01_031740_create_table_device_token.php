<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDeviceToken extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_device_token', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('attendee_id');
            $table->text('device_token')->default('');
            $table->unsignedBigInteger('venue_id');

            $table->foreign('attendee_id')
                ->references('id')->on('table_attendees')
                ->onDelete('cascade');
            
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
        Schema::dropIfExists('table_device_token');
    }
}
