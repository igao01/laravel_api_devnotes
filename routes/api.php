<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

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

Route::get('/ping', function (){
    return 'pong';
});

Route::get('/notes', [NoteController::class, 'list']);
Route::get('/note/{id}', [NoteController::class, 'read']);
Route::post('/note', [NoteController::class, 'create']);
Route::put('note/{id}', [NoteController::class, 'update']);
Route::delete('note/{id}', [NoteController::class, 'del']);