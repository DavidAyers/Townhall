<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venue;
use Illuminate\Support\Facades\Response;

class VenueController extends Controller
{
    //
    public function getVenue($venueId) {
        $venue = Venue::find($venueId);
        return Response::make($venue, 200);
    }

}
