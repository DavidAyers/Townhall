<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $table = 'table_messages';
    
    public function attendees() {
        return $this->belongsToMany("App\Attendee", "table_attendee_message" , 'message_id', 'attendee_id');
    }

    public function getAttendeesCount() {
        return $this->attendees->count();
    }
}
