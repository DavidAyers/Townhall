<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Speaker;
use Illuminate\Support\Facades\Response;

class SpeakerController extends Controller
{
    //
    public function getSpeakers() {
        $venueId = $_GET['venue_id'];
        $speakers = Speaker::where('venue_id', $venueId)->paginate(20);
        return Response::make($speakers, 200);
    }

    public function getSpeaker($speakerId) {
        $speaker = Speaker::find($speakerId);
        return Response::make($speaker, 200);
    }
}
