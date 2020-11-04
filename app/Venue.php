<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    //
    protected $table = 'table_venues';

    public function locations() {
        return $this->hasMany("App\Location", 'venue_id');
    }

    public function attendees() {
        return $this->hasMany("App\Attendee", 'venue_id');
    }

    public function agendas() {
        return $this->hasMany("App\Agenda", 'venue_id');
    }
}
