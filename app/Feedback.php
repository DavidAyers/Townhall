<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    //
    protected $table = 'table_feedbacks';

    public function attendees() {
        return $this->belongsToMany("App\Attendee", "table_attendee_feedback" , 'feedback_id', 'attendee_id');
    }
}
