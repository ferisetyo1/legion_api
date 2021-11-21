<?php

use App\Http\Controllers\AuthenticationController;
use App\Models\ResetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/password/reset', function () {
    if (isset($_GET['token'])) {
        if (ResetPassword::firstWhere('token', $_GET['token']) == null) {
            return abort('403');
        }
        return view('reset_password');
    } else {
        return abort('403');
    }
});
Route::post('/password/reset', [AuthenticationController::class, 'resetpassword']);
Route::get('sukses-reset', function () {
    return view('berhasil_ganti_password');
});
