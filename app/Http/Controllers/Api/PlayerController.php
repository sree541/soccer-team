<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index(){
        //Fetch the players from all team
        $players = Player::with('team:id,name')->get();
        return response()->json($players);
    }

    public function store(Request $request)
    {

        try {
            // Validate the request
            $reqData = $request->validate([
                'first_name' => 'required|max:255|min:2',
                'last_name' => 'required|max:255|min:2',
                'image_uri' => 'required|url',
                'team_id' => 'required|exists:teams,id'
            ]);

            // Create a new player
            $player = new Player;
            $player->first_name = $reqData['first_name'];
            $player->last_name = $reqData['last_name'];
            $player->player_image_uri = $reqData['image_uri'];
            $player->team_id = $reqData['team_id'];
            $player->save();

            //Success
            return response()->json([
                'status' =>  true,
                'message' => 'Player created successfully',
                'player' => $player
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation Errors
            return response()->json([
                'status' =>  false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 400);
        }catch (\Exception $e) {
            // Other exceptions
            return response()->json([
                'status' =>  false,
                'message' => 'Player creation failed',
                'error' => $e->getMessage()
            ], 500);

        }
    }

    public function update(Request $request, $player_id){

        try {

            //find player. Not validating the request if resource not found. 
            $player = Player::findOrFail($player_id);

            // Validate the request
            $reqData = $request->validate([
                'first_name' => 'required|max:255|min:2',
                'last_name' => 'required|max:255|min:2',
                'image_uri' => 'required|url',
                'team_id' => 'required|exists:teams,id'
            ]);

            //Update player data
            $player = new Player;
            $player->first_name = $reqData['first_name'];
            $player->last_name = $reqData['last_name'];
            $player->player_image_uri = $reqData['image_uri'];
            $player->team_id = $reqData['team_id'];
            $player->save();

            //Success
            return response()->json([
                'status' =>  true,
                'message' => 'Player updated successfully',
                'player' => $player
            ], 200);

        }catch (\Illuminate\Validation\ValidationException $e) {
            // Validation Errors
            return response()->json([
                'status' =>  false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 400);
        }catch (\Exception $e) {
            // Other exceptions
            return response()->json([
                'status' =>  false,
                'message' => 'Player update failed',
                'error' => $e->getMessage()
            ], 500);

        }
    }

    public function delete($player_id){
        try{
            //Remove player from db
            $player = Player::findOrFail($player_id);
            $player->delete();

            return response()->json([
                'status' =>  true,
                'message' => 'Player deleted successfully',
            ], 200);

        }catch (\Exception $e) {
            // Other exceptions
            return response()->json([
                'status' =>  false,
                'message' => 'Player delete failed',
                'error' => $e->getMessage()
            ], 500);

        }
        
    }

    public function get_team_players($team_id){
       //Fetch the players from one team
       $players = Player::where('team_id', $team_id)->with('team:id,name')->get();
       return response()->json($players);
    }

    public function get_players_by_id($id){
        $players = Player::where('id', $id)->with('team:id,name')->get();
        return response()->json($players);
    }

    public function get_players_by_name($name){
        $players = Player::where('first_name', "LIKE" ,"$name%")
                        ->orWhere('last_name', "LIKE" ,"$name%")
                        ->with(['team:id,name'])->get();
        return response()->json($players);
    }
}
