<?php

use App\Http\Controllers\AbandonQuestController;
use App\Http\Controllers\CompleteQuestController;
use App\Http\Controllers\CreateQuestController;
use App\Http\Controllers\MeController;
use App\Http\Controllers\SpendCoinsController;
use App\Http\Controllers\StartQuestController;
use App\Http\Controllers\ValidateQuestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    Route::get('me', MeController::class);
    Route::post('quests/{quest}/start', StartQuestController::class);
    Route::post('quests/{quest}/abandon', AbandonQuestController::class);
    Route::post('quests/{quest}/validate', ValidateQuestController::class);
    Route::post('quests/{quest}/complete', CompleteQuestController::class);

    Route::post('spend-coins', SpendCoinsController::class);

    Route::post('quests', CreateQuestController::class);
});

