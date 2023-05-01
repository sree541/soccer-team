<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    public function index(){
        //Fetch all the teams
        $teams = Team::all();
        return response()->json($teams);
    }

    public function store(Request $request)
    {

        try {
            // Validate the request
            $reqData = $request->validate([
                'name' => 'required|unique:teams|max:255|min:2',
                'logo_uri' => 'required',
            ]);
            // print_r($reqData);die;
            // Create a new team
            $team = new Team;
            $team->name = $reqData['name'];
            $team->logo_uri = $reqData['logo_uri'];
            $team->save();

            //Success
            return response()->json([
                'status' =>  true,
                'message' => 'Team created successfully',
                'team' => $team
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
                'message' => 'Team creation failed',
                'error' => $e->getMessage()
            ], 500);

        }
    }

    public function update(Request $request, $team_id){

        try {
            // print_r($request->json()->all());die;
            //find team. Not validating the request if resource not found. 
            $team = Team::findOrFail($team_id);

            // Validate the request
            $reqData = $request->validate([
                'name' => 'required|unique:teams,name,'.$team_id.'|max:255|min:2',
                'logo_uri' => 'required|url',
            ]);

            //Update team data
            $team->name = $reqData['name'];
            $team->logo_uri = $reqData['logo_uri'];
            $team->save();

            //Success
            return response()->json([
                'status' =>  true,
                'message' => 'Team updated successfully',
                'team' => $team
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
                'message' => 'Team update failed',
                'error' => $e->getMessage()
            ], 500);

        }
    }

    public function delete($team_id){
        try{
            //Remove team from db
            $team = Team::findOrFail($team_id);
            $team->delete();

            return response()->json([
                'status' =>  true,
                'message' => 'Team deleted successfully',
            ], 200);

        }catch (\Exception $e) {
            // Other exceptions
            return response()->json([
                'status' =>  false,
                'message' => 'Team delete failed',
                'error' => $e->getMessage()
            ], 500);

        }
        
    }

    public function get_team_players_by_id($id){
        //Fetch teams with id
        $teams = Team::where('id', $id)
                    ->with('players')
                    ->first();
        return response()->json($teams);
    }

    public function get_team_players_by_name($name){
        //Fetch teams with name or id
        $teams = Team::where('name','LIKE', "$name%")
                    ->with('players')
                    ->first();
        return response()->json($teams);
    }

}
