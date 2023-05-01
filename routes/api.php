<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\PlayerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', [AuthController::class, 'login']);

Route::get('/teams', [TeamController::class, 'index'])->name('get_teams');
Route::get('/teams/{id}/players', [TeamController::class, 'get_team_players_by_id'])->name('team_players')->where('id', '[0-9]+');
Route::get('/teams/{name}/players', [TeamController::class, 'get_team_players_by_name'])->name('team_players')->where('name', '[A-Za-z0-9]+');
Route::get('/players', [PlayerController::class, 'index'])->name('get_players');
Route::get('/players/{id}', [PlayerController::class, 'get_players_by_id'])->name('get_players')->where('id', '[0-9]+');;
Route::get('/players/{name}', [PlayerController::class, 'get_players_by_name'])->name('get_players')->where('name', '[A-Za-z0-9]+');;

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/teams', [TeamController::class, 'store'])->name('create_teams');
    Route::put('/teams/{team_id}', [TeamController::class, 'update'])->name('update_teams');
    Route::delete('/teams/{team_id}', [TeamController::class, 'delete'])->name('delete_teams'); 

    Route::post('/players', [PlayerController::class, 'store'])->name('create_players');
    Route::put('/players/{id}', [PlayerController::class, 'update'])->name('update_players');
    Route::delete('/players/{id}', [PlayerController::class, 'delete'])->name('delete_players');

});

