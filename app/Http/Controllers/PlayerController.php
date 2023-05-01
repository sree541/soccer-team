<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Route;

class PlayerController extends Controller
{
    public function index($player_id = NULL){

        $req = Request::create("/api/players/$player_id", 'GET');
        $response = app()->handle($req);
        if($response->status() == 200){
            $response = $response->getData();
        }else{
            $response = [];
        }
        return view('players-list',['players' => $response]);
    }

    public function create(){
        $teams = Team::all();
        return view('add-player',['teams' => $teams]);
    }

    public function store(Request $request){
        // echo "<pre>";print_r($request->getContent());die;
        try {
            $data = $request->validate([
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'team_id' => 'required',
                'image' => 'required|image',
            ]);

            $file = $request->file('image');
            $name = time().$file->getClientOriginalName();
            $file->move('player-images', $name);
    
            $imgPath = url('player-images/'.$name);
            $request->merge(['image_uri' => $imgPath]);
            $req = Request::create('/api/players', 'POST');
            $response = Route::dispatch($req);

            if ($response->status() === 200) {
                return redirect()->route('players')->with('success', 'Team created successfully.');
            } else {
                $error_res = json_decode($response->getContent(), true);
                return redirect()->back()->withInput()->withErrors($error_res['errors']);
            }
        }catch (\Illuminate\Validation\ValidationException $e) {
            // Validation Errors
            return redirect()->back()->withInput()->withErrors($e->errors());
        }catch (Exception $e) {
            // Other Errors
            return redirect()->back()->withInput()->withErrors($e->errors());
        }    
    }

    public function team_players($team_id){
        $req = Request::create('/api/players/'.$team_id, 'GET');
        $response = app()->handle($req)->getData();
        return view('players-list',['players' => $response]);
    }
    public function search(Request $request){
        if($request->input('term')) {
            $req = Request::create('/api/players/'.$request->input('term'), 'GET');
            $response = app()->handle($req)->getData();
            $data = $response;
        }else{
            $req = Request::create('/api/teams/'.$request->input('team').'/players', 'GET');
            $response = app()->handle($req)->getData();
            $data = [];
            if(isset($response->players)){
                foreach($response->players as $player){
                $player->team = (object)['name' => $response->name, 'logo_uri' => $response->logo_uri];
                    $data[] = $player;
                }
            }

            // echo "<pre>"; print_r($data);die;
        }
        
        return view('players-list',['players' => $data]);
    }
}
