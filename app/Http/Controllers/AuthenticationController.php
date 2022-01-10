<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\customer;
use App\Models\gym;
use App\Models\ResetPassword;
use App\Models\trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use \Validator;
use App\Models\User;
use Database\Seeders\CustomerSeeder;
use Exception;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    public function login($role, Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            $respon = [
                'status' => 'error',
                'msg' => 'Validator error',
                'data' => $validate->errors(),
            ];
            return response()->json($respon, 400);
        } else {
            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                $respon = [
                    'status' => 'error',
                    'msg' => 'Unathorized',
                    'data' => null,
                ];
                return response()->json($respon, 401);
            }

            $user = User::where('email', $request->email)->where('role', $role)->first();
            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Error in Login');
            }

            $tokenResult = $user->createToken('token-auth')->plainTextToken;
            $respon = [
                'status' => 'success',
                'msg' => 'Login successfully',
                'data' => [
                    'access_token' => $tokenResult,
                    'token_type' => 'Bearer',
                ]
            ];
            return response()->json($respon, 200);
        }
    }

    public function logingoogle($role, Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required'
        ]);
        if ($validate->fails()) {
            $respon = [
                'status' => 'error',
                'msg' => 'Validator error',
                'data' => $validate->errors(),
            ];
            return response()->json($respon, 200);
        } else {
            $user = User::where('email', $request->email)->where('role', $role)->first();
            if ($user == null) {
                $respon = [
                    'status' => 'error',
                    'msg' => 'Unathorized',
                    'data' => null,
                ];
                return response()->json($respon, 401);
            }
            $tokenResult = $user->createToken('token-auth')->plainTextToken;
            $respon = [
                'status' => 'success',
                'msg' => 'Login successfully',
                'data' => [
                    'access_token' => $tokenResult,
                    'token_type' => 'Bearer',
                ]
            ];
            return response()->json($respon, 200);
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();
        $respon = [
            'status' => 'success',
            'msg' => 'Logout successfully',
            'data' => null,
        ];
        return response()->json($respon, 200);
    }

    public function registercustomer(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user == null) {
            $user = User::insert([
                'email' => $request->email,
                'name' => $request->nama,
                'password' => Hash::make($request->password),
                'free_password' => $request->isgoogle == "isgoogle",
                'role' => 'customer',
                'foto' => $request->foto,
            ]);
            $user = User::find(DB::getPdo()->lastInsertId());
            customer::insert([
                'customer_user_id' => $user->id,
                'customer_nama' => $request->nama,
                'customer_tinggi' => $request->tinggi,
                'customer_berat' => $request->berat,
                'customer_gender' => $request->gender,
                'customer_image' => $request->foto
            ]);
            $tokenResult = $user->createToken('token-auth')->plainTextToken;
            $respon = [
                'status' => "success",
                'msg' => 'Berhasil Register',
                'data' => [
                    'access_token' => $tokenResult,
                    'token_type' => 'Bearer',
                ],
            ];
            return response()->json($respon, 200);
        }

        if ($request->isgoogle == "isgoogle") {
            $tokenResult = $user->createToken('token-auth')->plainTextToken;
            $respon = [
                'status' => "success",
                'msg' => 'Berhasil Register',
                'data' => [
                    'access_token' => $tokenResult,
                    'token_type' => 'Bearer',
                ],
            ];
            return response()->json($respon, 200);
        }
        $respon = [
            'status' => "success",
            'msg' => 'Gagal register email sudah dipakai',
            'data' => null
        ];
        return response()->json($respon, 400);
    }

    public function logoutall(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        $respon = [
            'status' => 'success',
            'msg' => 'Logout successfully',
            'data' => null,
        ];
        return response()->json($respon, 200);
    }

    public function getuserinfo(Request $request)
    {
        $user = User::with('gym', 'trainer', 'customer')->findOrFail($request->user()->id);
        $respon = [
            'status' => 'success',
            'msg' => 'Berhasil mendapatkan data user',
            'data' => $user,
        ];
        return response()->json($respon, 200);
    }

    public function requestreset(Request $request)
    {
        $user = User::firstWhere('email', $request->email);
        if ($user != null) {
            $token = md5(uniqid($user->email, true));
            ResetPassword::insert(['email' => $request->email, 'token' => $token]);
            Mail::to($request->email)->send(new \App\Mail\ResetPassword(['url_reset' => url("password/reset?token=$token")]));
            $respon = [
                'status' => 'success',
                'msg' => 'Email berhasil terkirim',
                'data' => null,
            ];
            return response()->json($respon, 200);
        } else {
            $respon = [
                'status' => 'success',
                'msg' => 'User tidak ditemukan',
                'data' => null,
            ];
            return response()->json($respon, 400);
        }
    }

    public function resetpassword(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'password' => 'required|min:8|required_with:password_confirmed|same:password_confirmed',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->with("error", "Password harus 8 karakter dan cocok.");
        } else {
            $resetpassword = ResetPassword::firstWhere('token', $request->token);
            $user = User::firstWhere('email', $resetpassword->email);
            $user->password = Hash::make($request->password);
            $user->save();
            $resetpassword->delete();
            return redirect('sukses-reset');
        }
    }

    public function updateprofil(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama' => "required:min:4",
            'tinggi' => 'numeric',
            'berat' => 'numeric',
        ]);
        if ($validate->fails()) {
            $respon = [
                'status' => 'error',
                'msg' => 'Validator error',
                'data' => $validate->errors(),
            ];
            return response()->json($respon, 400);
        } else {
            $user = User::with('customer', 'trainer')->find($request->user()->id);
            $user->name = $request->nama;
            if ($request->has('foto')) {
                $file = base64_decode(trim($request->foto));
                $folderName = 'public/uploads/';
                if (!is_dir(public_path() . '/uploads/')) {
                    mkdir(public_path() . '/uploads/');
                }
                $saveName = $user->id . time() . '.' . 'png';
                $success = file_put_contents(public_path() . '/uploads/' . $saveName, $file);
                $user->foto = asset('uploads/' . $saveName);
            }
            $user->save();
            if ($user->role == "customer") {
                // $customer = customer::find($user->customer->customer_id);
                $user->customer->customer_nama = $request->nama;
                $user->customer->customer_tinggi = $request->tinggi;
                $user->customer->customer_berat = $request->berat;
                $user->customer->customer_gender = $request->gender;
                $user->customer->save();
            }
            if ($user->role == "trainer") {
                // $trainer = trainer::find($user->trainer->pt_id);
                $user->trainer->pt_nama = $request->nama;
                $user->trainer->pt_tinggi = $request->tinggi;
                $user->trainer->pt_berat = $request->berat;
                $user->trainer->pt_gender = $request->gender;
                $user->trainer->save();
                // $user->trainer=$trainer;
            }
            $user->save();
            $user->refresh();

            $respon = [
                'status' => 'Success',
                'msg' => 'Success update user.',
                'data' => $user,
                'size' => $this->getBase64ImageSize(trim($request->foto))
            ];
            return response()->json($respon, 200);
        }
    }

    public function getBase64ImageSize($base64Image)
    { //return memory size in B, KB, MB
        try {
            $size_in_bytes = (int) (strlen(rtrim($base64Image, '=')) * 3 / 4);
            $size_in_kb    = $size_in_bytes / 1024;
            $size_in_mb    = $size_in_kb / 1024;

            return $size_in_mb;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function gantipassword(Request $request)
    {
        $user = User::with('customer', 'trainer')->find(auth()->user()->id);
        if ($user->free_password == 0) {
            if (!Hash::check($request->password_lama, $user->password, [])) {
                $respon = [
                    'status' => 'Failed',
                    'msg' => 'Password salah',
                    'data' => null
                ];
                return response()->json($respon, 400);
            }
        }
        $user->free_password = 0;
        $user->password = Hash::make($request->password);
        $user->save();
        $respon = [
            'status' => 'Success',
            'msg' => 'Password berhasil diganti.',
            'data' => $user
        ];
        return response()->json($respon, 200);
    }
}
