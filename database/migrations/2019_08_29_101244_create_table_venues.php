<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVenues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_venues', function (Blueprint $table) {
            $table->bigIncrements('id');
            

            $table->string('name', 100)->default('');

            $table->text('detail_hotel')->default('');
            $table->text('things_area')->default('');
            $table->text('transportation')->default('');
            $table->text('driving')->default('');

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
        Schema::dropIfExists('table_venues');
    }
}
