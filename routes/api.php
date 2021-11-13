<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TransaksiTrainingController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('banner', [BannerController::class, 'index']);
Route::post('banner/create', [BannerController::class, 'create']);
Route::post('login', [AuthenticationController::class, 'login']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('logout', [AuthenticationController::class, 'logout']);
    Route::post('logoutall',  [AuthenticationController::class, 'logoutall']);
    Route::get('user-info',  [AuthenticationController::class, 'getuserinfo']);
    Route::get('home/banner',  [TransaksiTrainingController::class, 'index']);
    Route::get('home/notificationcount',  [NotificationController::class, 'notificationcount']);
    Route::get('home/privateberlangsung',  [TransaksiTrainingController::class, 'privateberlangsung']);
});

Route::get('/', function () {
    return [
        'status' => 'error',
        'msg' => 'Unathorized',
        'data' => null,
    ];
})->name('login');
