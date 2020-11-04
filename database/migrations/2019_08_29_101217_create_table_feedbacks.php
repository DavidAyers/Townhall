<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFeedbacks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_feedbacks', function (Blueprint $table) {
            $table->bigIncrements('id');
            

            $table->text('question')->default('');
            $table->unsignedBigInteger('agenda_id');

            $table->foreign('agenda_id')
                ->references('id')->on('table_agendas')
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
        Schema::dropIfExists('table_feedbacks');
    }
}
