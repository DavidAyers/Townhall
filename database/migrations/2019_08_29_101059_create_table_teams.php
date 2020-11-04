<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTeams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_teams', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('bio', 100)->default('');
            $table->string('part_of_company', 100)->default('');
            $table->string('image', 100)->default('');
            $table->text('bullet1')->default('');
            $table->text('bullet2')->default('');
            $table->text('bullet3')->default('');
            $table->text('bullet4')->default('');
            $table->text('bullet5')->default(''); 

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
        Schema::dropIfExists('table_teams');
    }
}
