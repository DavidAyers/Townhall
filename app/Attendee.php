<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    //
    protected $table = 'table_attendees';

    protected $fillable = ['image','primary_email', 'secondary_email', 'first_name', 'middle_name', 'last_name', 'department', 'job', 'manager_name', 'manager_title', 'office_location', 'primary_number', 'cell_number', 'emergency_contract_name', 'emergency_contract_phone', 'air_travel_assistance', 'hotel_room', 'dietary_concerns', 'password', 'venue_id']; 

    public function messages() {
        return $this->belongsToMany("App\Message", "table_attendee_message" , 'attendee_id', 'message_id');
    }

    public function feedbacks() {
        return $this->belongsToMany("App\Feedback", "table_attendee_feedback" , 'attendee_id', 'feedback_id');
    }

    public function venue() {
        return $this->belongsTo("App\Venue", 'venue_id');
    }
}
