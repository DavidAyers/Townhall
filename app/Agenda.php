<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    //
    protected $table = 'table_agendas';

    public function location() {
        return $this->belongsTo("App\Location", 'location_id');
    }

    public function venue() {
        return $this->belongsTo("App\Venue", 'venue_id');
    }
}
