<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSocials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_socials', function (Blueprint $table) {
            $table->bigIncrements('id');    
            
            $table->string('image', 100)->default('');
            $table->text('text')->default('');
            $table->integer('likes')->default(0);

            $table->unsignedBigInteger('attendee_id');
            $table->foreign('attendee_id')
                ->references('id')->on('table_attendees')
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
        Schema::dropIfExists('table_socials');
    }
}
