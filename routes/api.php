<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\v1\WeatherController;
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

Route::group(['prefix' => '/v1', 'namespace' => 'Api\v1', 'as' => 'api.'], function () {
    Route::get('weather/generateTestData', [WeatherController::class, 'generateTestData']);
    Route::get('weather/getLastTemp', [WeatherController::class, 'getLastTemp']);
    Route::get('weather/getLastTemps', [WeatherController::class, 'getLastTemps']);
    Route::get('weather/getTempsByDates', [WeatherController::class, 'getTempsByDates']);
});
