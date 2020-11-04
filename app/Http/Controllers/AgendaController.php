<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agenda;
use Illuminate\Support\Facades\Response;
use App\Location;

class AgendaController extends Controller
{
    //
    public function getAgendas() {
        $venueId = $_GET["venue_id"];
        $agendas = Agenda::get()->reject(function ($agenda) use ($venueId) {
            return Location::find($agenda->location_id)->venue_id != $venueId;
        });
        foreach($agendas as $agenda) {
            $agenda["location"] = Location::find($agenda->location_id) ? Location::find($agenda->location_id)->location : "";
        }
        return Response::make($agendas, 200);
    }

    public function getAgenda($agendaId) {
        $agenda = Agenda::find($agendaId);
        return Response::make($agenda, 200);
    }
}
