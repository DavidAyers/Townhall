<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Team;

class TeamController extends Controller
{
    

    public function getTeams() {
        $teams = Team::paginate(20);
        return Response::make($teams, 200);
    }

    public function getTeam($teamId) {
        $team = Team::find($teamId);
        return Response::make($team, 200);
    }
}
