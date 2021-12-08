<?php

use App\Http\Controllers\AlamatPrivateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\GymController;
use App\Http\Controllers\HargaTrainerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\TransaksiPrivatController;
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
    Route::post('user/update/customer',  [AuthenticationController::class, 'updateprofilcustomer']);
    Route::get('home/notificationcount',  [NotificationController::class, 'notificationcount']);
    Route::get('gyms',  [GymController::class, 'index']);
    Route::get('gyms/{id}',  [GymController::class, 'show']);
    Route::get('products',  [ProdukController::class, 'index']);
    Route::get('products/{id}',  [ProdukController::class, 'show']);
    Route::get('trainers',  [TrainerController::class, 'index']);
    Route::get('trainers/{id}',  [TrainerController::class, 'show']);
    Route::post('trainers/add/price',  [HargaTrainerController::class, 'create']);
    Route::get('alamatprivate',  [AlamatPrivateController::class, 'index']);
    Route::post('alamatprivate/add',  [AlamatPrivateController::class, 'create']);
    Route::post('alamatprivate/update',  [AlamatPrivateController::class, 'edit']);
    Route::post('transaksiprivate/add',  [TransaksiPrivatController::class, 'create']);
    Route::get('transaksiprivate',  [TransaksiPrivatController::class, 'index']);
    Route::get('transaksiprivate/{id}',  [TransaksiPrivatController::class, 'show']);
});

Route::get("testing2", function () {
    $privatekey = "-----BEGIN RSA PRIVATE KEY-----
    MIIEogIBAAKCAQEAyIkSQ5Y9wFUP08vI5PmHbsFr28Yx/dxocGZFp/bY+tf45kHn
    AKV8jg0EuH4CByze4yStPBpobWq+qiAZO4gZx652KeLZGoPPTT5Q72bJ3mhc2b1n
    Lkn+VQqlQFXv4AAUFxFmBtWbO7QZaZP2ytcMlt1CkY3F+/3x1OaIZvS6srf0j6uk
    xzLx7a8MYVNTMw8I1bs0DfUwEWoZ6I7BrZKS/maPOOEb8lcoAEtyFW19MpoHgPv0
    1431JxYaouFRxvsDymdORLolmmBFDz5y68fePOUe315Uo2rUadE2uHTgSUlFp1zG
    QApQjujAzrCa28qnNQrGAK8EY+FKfbZhLKjyJQIDAQABAoIBAE4fMBFKZ1YVDSxq
    WCHzn7IjAdzFUlZeVgVrojkz7gWSu3EgPVjAH0zLf4pL9IhND6uXbzFZ7FKr4gku
    pgXOGJT0vy3EJOWyccDaxPbuqTfOmlVs9tROmRkSI5xznhY6kZkG+yMwdeAFYl0B
    +oO80Te4jKVdgMKRhHN3N648KrtSQs6nlIxWgdHEr7uJ3PBdORXq3FZE/dRAiwix
    AqQKFzk4WhVu/9xD0CxzgAlr5Uee/ulVmcn06YUL97ymWZpsDjGShAPcljuCILsK
    bl4aBXK2MzvajdYy/FUD4NpHftonm2yYpyjt4OBgaRllKTP8feJjyORymXHhLYqT
    WyLFEsUCgYEA/55FnQ+o0fku3G2FcLDx+RLPn/oYHuywz7rLGS0Z0lAjbBlx8US0
    bV+5GOveELI6xBGwzBlZaoAgdKpu7EMCP+t8/clxdRP31kt//4siGCEV/CFxC8nj
    2HtAL5V95kvjqbmNGs37eyUcA5YbvDjKmwdkvwnm/GggpvFn4HzuHWsCgYEAyNW9
    eUs8sc4xQnMxDqzOlebMJrOUq7zZn8HQGTHxVcT6TD7rE+d8Ht1g+vggsDgDq9U0
    AWlRxpBnZaalQEcFV8Xru3nnegHTtZ0oiFQj0/+tQ9SexBq5i4n5KO0TdkSvOMJ2
    rqscgJ9H8kvH2eHnHJVufBPLbnHdV45DUL74Aq8CgYAGU455gqe0+qvUPMmurlJu
    za5h0TjDmywNGBxqtRkMgXs+86pERGUKx/G20i+ezipyK9XqVz5FSoKDIKy6IDZw
    Co3/Yfry4Nmjbh7u3iyr2DXJFbLMjeSbuQEvrE1/Y6Vwz+zUGwD8XUDCPfbVw7oP
    +DDgIYib+p/EQflGLxFdnQKBgGVcGoiBBFzop8vVv0icxpa5KQfPUpVqdps+gfx1
    TEvxYjHg/1vIVMhvCmcfm7/URWYP8HNV6EPC1axj8rsCHRwzc8nmuIDHM0ZRzwcf
    EAYK4DN/t7FZm5NlSy7wmAX0nEqVOrjk+zmfKfyLao34iV/Puzc79kwDg6aQ0kCK
    YTlZAoGARKIKJKcbRU+W1+UjcVhD+rb7qALLPA2VdVqkviAVpdymFf//XR0NWA69
    gNT4LJx3GvfZFtL90LDjHrG4K5FmiXvfNxKpowkcT2nKnlYfrwi/I1vkEF+5kb3i
    uDl3e11e6es212d2FvVhFntO1lFGjvB8e2GcWZ0XpKSsAUhm1B4=
    -----END RSA PRIVATE KEY-----";
    $publickey = "-----BEGIN PUBLIC KEY-----
    MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtJuWjky2k37dm7i3pep1
    8WE8pwJNwsc/itRSh79u1VUNPvqoH6D0IXKIc12gUvtv3A2Fqq5LyCWkMIbDOG0v
    Q/dt8Mf5Fz+nzbuI+i1iZni1cTRdl39fKTUdzFeMpOfLqsrPe2HSfKVBed/ILG6q
    w6MZuPM1AprXTXVLjz/lJnMLPZUlPRyy4WxCxPe4mrhDCqD4Z+YKVtpE+e/jhPBu
    NcIoxn2QNUm0dLmbbBcTfPbfIT/D088gNrHv0kWKAPuwkdifxzjE9LBeivaVIP2Y
    UXdIpGUjRM/HDmdVy8zs+0hWmwt7fNJSlCFYSbZfJQ8V0CWHOWRVKdVvzpH9EXoM
    EwIDAQAB
    -----END PUBLIC KEY-----
    ";

    $data = 'plaintext data goes here';

    // Encrypt the data to $encrypted using the public key
    openssl_public_encrypt($data, $encrypted, $publickey);

    echo $encrypted;

    // Decrypt the data using the private key and store the results in $decrypted
    openssl_private_decrypt($encrypted, $decrypted, $privatekey);

    echo $decrypted;

});
Route::get("testing", function () {
    // $data = "this is data";
    $data=base64_encode(json_encode(["request"=>[
        "vendorIdentifier"=>"CZ00TEST001",
        "token"=>"",
        "referenceId"=>"Test01-003",
        "entityId"=>"23271",
        "merchantName"=>"Test 01 CZ IT",
        "merchantDescription"=>"Cashlez Sunter",
        "currencyCode"=>"IDR",
        "amount"=>"100",
        "callbackSuccess"=>"",
        "callbackFailure"=>"",
        "message"=>"",
        "description"=>"Transaction Test Cashlez Sunter",
        "transactionUsername"=>"test01"
    ]]));
    $privateKeyId = openssl_pkey_get_private(file_get_contents("https://raw.githubusercontent.com/ferisetyo1/legion_images_dummy/master/pkcs1_merchant_private.pem"));
    openssl_sign($data, $signature, $privateKeyId, OPENSSL_ALGO_SHA256);
    openssl_free_key($privateKeyId);
    echo "signature: \n" . base64_encode($signature) . "\n";

    $publicKeyId = openssl_pkey_get_public(file_get_contents("https://raw.githubusercontent.com/ferisetyo1/legion_images_dummy/master/cashlez_public.pem"));
    $result = openssl_verify($data, $signature, $publicKeyId, OPENSSL_ALGO_SHA256);
    openssl_free_key($publicKeyId);
    if ($result == 1) {
        echo "result: valid\n";
    } elseif ($result == 0) {
        echo "result: invalid\n";
    } else {
        echo "result: error\n";
    }
});

Route::get('/', function () {
    $respon = [
        'status' => 'error',
        'msg' => 'Unathorized',
        'data' => null,
    ];
    return response()->json($respon, 401);
})->name('login');
