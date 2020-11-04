<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\AttendeesImport;
use Excel;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Http\Request;
use App\Location;

class ApiController extends Controller
{
    //\
    public function getLocationIdByVenue(Request $request) {
        $q = $request->get('q');
        $locations = Location::where('venue_id', $q)->get()->map(function($location) {
            return ['id' => $location->id, 'text' => $location->location];
        });
        return $locations;
    }
}
