<?php

namespace App\Http\Controllers;

use App\Attendee;
use Illuminate\Http\Request;
use App\Message;
use App\AttendeeMessage;
use Illuminate\Support\Facades\Response;

class NotificationController extends Controller
{
    //
    public function getNotifications() {
        $venueId = $_GET["venue_id"];
        $attendeeId = $_GET["attendee_id"];
        $notifications = Message::where('type', "notification_to_venue")->where('venue_id' , $venueId)->orWhere('type', "notification_to_all")->get();
        foreach($notifications as $notification) {
            $cnt = AttendeeMessage::where("attendee_id", $attendeeId)->where('message_id', $notification->id)->count();
            $notification["is_read"] = $cnt < 1 ? false : true;
        }
        return Response::make($notifications, 200);
    }

    public function checkedNotification($userId, $notificationId) {
        $newAttendMessage = new AttendeeMessage();
        $newAttendMessage->attendee_id = $userId;
        $newAttendMessage->message_id = $notificationId;
        $newAttendMessage->save();

        $result["status"] = "success";
        return Response::make($result, 200);
    }
}
