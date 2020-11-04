<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAttendeeMessage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_attendee_message', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('attendee_id');
            $table->unsignedBigInteger('message_id');

            $table->foreign('attendee_id')
                ->references('id')->on('table_attendees')
                ->onDelete('cascade');

            $table->foreign('message_id')
                ->references('id')->on('table_messages')
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
        Schema::dropIfExists('table_attendee_message');
    }
}
