<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAttendees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_attendees', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string("image", 100);
            $table->string("primary_email", 100)->unique();
            $table->string("secondary_email", 100)->default("")->nullable();
            $table->string("first_name", 100)->default("")->nullable();
            $table->string("middle_name", 100)->default("")->nullable();
            $table->string("last_name", 100)->default("")->nullable();
            $table->string("department", 100)->default("")->nullable();
            $table->string("job", 100)->default("")->nullable();
            $table->string("manager_name", 100)->default("")->nullable();
            $table->string("manager_title", 100)->default("")->nullable();
            $table->string("office_location", 100)->default("")->nullable();
            $table->string("primary_number", 100)->default("")->nullable();
            $table->string("cell_number", 100)->default("")->nullable();
            $table->string("emergency_contract_name", 100)->default("")->nullable();
            $table->string("emergency_contract_phone", 100)->default("")->nullable();
            $table->string("air_travel_assistance", 100)->default("Yes")->nullable();
            $table->string("hotel_room", 100)->default("Yes")->nullable();
            $table->string("dietary_concerns", 100)->default("")->nullable();
            $table->string("password", 100);

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
        Schema::dropIfExists('table_attendees');
    }
}
