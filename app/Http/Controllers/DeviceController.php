<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use Illuminate\Http\Response;

class DeviceController extends Controller
{
    //
    public function registerDevice() {
        $deviceToken = $_POST["device_token"];
        $attendeeId = $_POST["attendee_id"];
        $venueId = $_POST["venue_id"];

        $exist = Device::where("attendee_id" , $attendeeId)->first();

        $result["status"] ="exits";

        if($exist) {
            return Response::make($result, 200);
        }
        $device = new Device();
        $device->attendee_id = $attendeeId;
        $device->device_token = $deviceToken;
        $device->venue_id = $venueId;
        $device->save();

        $result["status"] ="success";
        return Response::make($result, 200);

    }
}
