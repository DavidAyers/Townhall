<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAttendeeFeedback extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_attendee_feedback', function (Blueprint $table) {
            $table->bigIncrements('id');
            

            $table->unsignedBigInteger('attendee_id');
            $table->unsignedBigInteger('feedback_id');
            $table->integer('answer')->default(0);

            $table->foreign('attendee_id')
                ->references('id')->on('table_attendees')
                ->onDelete('cascade');
            $table->foreign('feedback_id')
                ->references('id')->on('table_feedbacks')
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
        Schema::dropIfExists('table_attendee_feedback');
    }
}
