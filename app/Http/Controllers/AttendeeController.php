<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Attendee;
use Illuminate\Support\Facades\Response;

class AttendeeController extends Controller
{
    //
    public function login() {
        $primaryEmail = $_POST["email"];
        $password = $_POST["password"];

        $attendee = Attendee::where("primary_email", $primaryEmail)->first();

        $result["status"] = 0;
        $result["message"] = "Invalid Email and Password!";
        $result["data"] = null;
        if($attendee) {
            if(Hash::check($password, $attendee->password)) {
                $result["status"] = 1;
                $result["message"] = "Sign In Success!";
                $result["data"] = $attendee;
            }
        }

        return Response::make($result, 200);
    }

    public function logout() {
        
    }

    //
    public function getAttendees() {
        $attendees = Attendee::paginate(20);
        return Response::make($attendees, 200);
    }

    public function getAttensdee($attendeeId) {
        $attendee = Attendee::find($attendeeId);
        return Response::make($attendee, 200);
    }
}
