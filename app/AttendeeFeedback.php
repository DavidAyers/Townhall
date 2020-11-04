<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendeeFeedback extends Model
{
    //
    protected $table = 'table_attendee_feedback';

    public function attendee() {
        return $this->belongsTo("App\Attendee", 'attendee_id');
    }
}
