<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            

            $table->unsignedBigInteger('attendee_id');
            $table->unsignedBigInteger('social_id');
            $table->text('text')->default('');

            $table->foreign('attendee_id')
                ->references('id')->on('table_attendees')
                ->onDelete('cascade');
            
            $table->foreign('social_id')
                ->references('id')->on('table_socials')
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
        Schema::dropIfExists('table_comments');
    }
}
