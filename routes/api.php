<?php

use App\Http\Controllers\AlamatPengirimanController;
use App\Http\Controllers\AlamatPrivateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\GymController;
use App\Http\Controllers\HargaTrainerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProdukKategoriController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\TransaksiPrivatController;
use App\Http\Controllers\TransaksiProdukController;
use App\Http\Controllers\TransaksiTrainingController;
use App\Http\Controllers\WishlistProdukController;
use App\Models\AlamatPengiriman;
use App\Models\HargaTrainer;
use App\Models\TransaksiProduk;

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
Route::post('login/{role}', [AuthenticationController::class, 'login']);
Route::post('login/{role}/google', [AuthenticationController::class, 'logingoogle']);
Route::post('register/customer', [AuthenticationController::class, 'registercustomer']);
Route::post('password/reset/request', [AuthenticationController::class, 'requestreset']);
Route::get("transaksiproduk/paid/{inv}",[TransaksiProdukController::class,"paidTransaksi"]);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('logout', [AuthenticationController::class, 'logout']);
    Route::post('logoutall',  [AuthenticationController::class, 'logoutall']);
    Route::get('user-info',  [AuthenticationController::class, 'getuserinfo']);
    Route::post('user/update/customer',  [AuthenticationController::class, 'updateprofilcustomer']);
    Route::get('home/notificationcount',  [NotificationController::class, 'notificationcount']);
    Route::get('gyms',  [GymController::class, 'index']);
    Route::get('gyms/{id}',  [GymController::class, 'show']);
    Route::get('products',  [ProdukController::class, 'index']);
    Route::get('products/kategori',  [ProdukKategoriController::class, 'index']);
    Route::get('products/{id}',  [ProdukController::class, 'show']);
    Route::get('trainers',  [TrainerController::class, 'index']);
    Route::get('trainers/{id}',  [TrainerController::class, 'show']);
    Route::post('trainers/add/price',  [HargaTrainerController::class, 'create']);
    Route::get('alamatprivate',  [AlamatPrivateController::class, 'index']);
    Route::post('alamatprivate/add',  [AlamatPrivateController::class, 'create']);
    Route::post('alamatprivate/update',  [AlamatPrivateController::class, 'edit']);
    Route::get('alamatprivate/counter',  [AlamatPrivateController::class, 'counter']);
    Route::get('alamatpengiriman',  [AlamatPengirimanController::class, 'index']);
    Route::post('alamatpengiriman/add',  [AlamatPengirimanController::class, 'create']);
    Route::post('alamatpengiriman/update',  [AlamatPengirimanController::class, 'edit']);
    Route::post('alamatpengiriman/cost',  [AlamatPengirimanController::class, 'cost']);
    Route::get('alamatpengiriman/counter',  [AlamatPengirimanController::class, 'counter']);
    Route::post('transaksiprivate/add',  [TransaksiPrivatController::class, 'create']);
    Route::get('transaksiprivate',  [TransaksiPrivatController::class, 'index']);
    Route::get('transaksiprivate/verify',  [TransaksiPrivatController::class, 'verify']);
    Route::get('transaksiprivate/{id}',  [TransaksiPrivatController::class, 'show']);
    Route::get('transaksiprivate-count',  [TransaksiPrivatController::class, 'counter']);
    Route::get('cart',  [CartController::class, 'index']);
    Route::post('cart/add',  [CartController::class, 'create']);
    Route::post('cart/edit',  [CartController::class, 'update']);
    Route::post('cart/delete',  [CartController::class, 'delete']);
    Route::post("info/checkout",[TransaksiProdukController::class,"infocheckout"]);
    Route::get("transaksiproduk",[TransaksiProdukController::class,"index"]);
    Route::post("transaksiproduk/add",[TransaksiProdukController::class,"create"]);
    Route::get("transaksiproduk/show/{id}",[TransaksiProdukController::class,"show"]);
    Route::get("transaksiproduk/counter",[TransaksiProdukController::class,"counter"]);
    Route::get("wishproduk",[WishlistProdukController::class,"index"]);
    Route::get("wishproduk/wishes/{prodid}",[WishlistProdukController::class,"wish"]);
    Route::get("wishproduk/prodlistwish/{prodid}",[WishlistProdukController::class,"produklistwish"]);
    Route::get("wishproduk/counter",[WishlistProdukController::class,"counter"]);
});

Route::get('/', function () {
    $respon = [
        'status' => 'error',
        'msg' => 'Unathorized',
        'data' => null,
    ];
    return response()->json($respon, 401);
})->name('login');
