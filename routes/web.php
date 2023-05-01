<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',  [TeamController::class, 'index']);


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('new-team', [TeamController::class, 'create'])->name('teams.create');
    Route::post('/store-team', [TeamController::class, 'store'])->name('teams.store');
    Route::get('/new-player', [PlayerController::class, 'create'])->name('players.create');
    Route::post('/store-player', [PlayerController::class, 'store'])->name('players.store');
});

Route::get('/teams', [TeamController::class, 'index'])->name('teams');
Route::get('/teams/{id}', [TeamController::class, 'getTeamPlayers'])->name('teams.players');
Route::get('/players/{id?}', [PlayerController::class, 'index'])->name('players');
Route::post('/players/search/', [PlayerController::class, 'search'])->name('players.search');
// Route::get('/players/{id}', [PlayerController::class, 'index'])->name('players');
