<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $table = 'table_locations';

    public function venue() {
        return $this->belongsTo("App\Venue", 'venue_id');
    }

    public function agendas() {
        return $this->hasMany("App\Agenda", 'location_id');
    }
}
