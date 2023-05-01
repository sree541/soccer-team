<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use App\Models\Team;


class TeamController extends Controller
{
    public function index(){
        $req = Request::create('/api/teams', 'GET');
        $response = app()->handle($req)->getData();
        return view('team-list',['teams' => $response]);
    }

    public function create(){
        return view('add-team',[]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255|unique:teams,name',
            'logo' => 'required|image',
        ]);

        $file = $request->file('logo');
        $name = time().$file->getClientOriginalName();
        $file->move('logos', $name);
 
        $logoPath = url('logos/'.$name);
        $request->merge(['logo_uri' => $logoPath]);
        $req = Request::create('/api/teams', 'POST');
        $response = Route::dispatch($req);

        if ($response->status() === 200) {
            return redirect()->route('teams')->with('success', 'Team created successfully.');
        } else {
            $error_res = json_decode($response->getContent(), true);
            return redirect()->back()->withInput()->withErrors($error_res['errors']);
        }
    }

    public function getTeamPlayers($team_id){
        $req = Request::create("/api/teams/$team_id/players", 'GET');
        $response = app()->handle($req)->getData();
        return view('team-players',['team' => $response]);
    }

}
