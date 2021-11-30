<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\GymController;
use App\Http\Controllers\HargaTrainerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\TransaksiTrainingController;
use App\Models\HargaTrainer;

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
Route::post('login/google', [AuthenticationController::class, 'logingoogle']);
Route::post('register/customer', [AuthenticationController::class, 'registercustomer']);
Route::post('password/reset/request', [AuthenticationController::class, 'requestreset']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('logout', [AuthenticationController::class, 'logout']);
    Route::post('logoutall',  [AuthenticationController::class, 'logoutall']);
    Route::get('user-info',  [AuthenticationController::class, 'getuserinfo']);
    Route::get('home/banner',  [TransaksiTrainingController::class, 'index']);
    Route::get('home/notificationcount',  [NotificationController::class, 'notificationcount']);
    Route::get('home/privateberlangsung',  [TransaksiTrainingController::class, 'privateberlangsung']);
    Route::get('gyms',  [GymController::class, 'index']);
    Route::get('gyms/{id}',  [GymController::class, 'show']);
    Route::get('products',  [ProdukController::class, 'index']);
    Route::get('products/{id}',  [ProdukController::class, 'show']);
    Route::get('trainers',  [TrainerController::class, 'index']);
    Route::get('trainers/{id}',  [TrainerController::class, 'show']);
    Route::post('trainers/add/price',  [HargaTrainerController::class, 'create']);
});

Route::get('/', function () {
    $respon = [
        'status' => 'error',
        'msg' => 'Unathorized',
        'data' => null,
    ];
    return response()->json($respon, 401);
})->name('login');
