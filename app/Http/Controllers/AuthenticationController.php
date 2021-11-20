<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\customer;
use App\Models\gym;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use \Validator;
use App\Models\User;
use Database\Seeders\CustomerSeeder;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    public function login(Request $request)
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

            $user = User::where('email', $request->email)->first();
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

    public function logingoogle(Request $request)
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
            $user = User::where('email', $request->email)->first();
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
        if ($user==null) {
            $user = User::insert([
                'email' => $request->email,
                'name' =>$request->nama,
                'password' => Hash::make($request->password),
                'role' => 'customer',
                
            ]);
            $user=User::find(DB::getPdo()->lastInsertId());
            customer::insert([
                'customer_user_id'=>$user->id,
                'customer_nama'=>$request->nama,
                'customer_tinggi'=>$request->tinggi,
                'customer_berat'=>$request->berat,
                'customer_gender'=>$request->gender,
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

        if ($request->isgoogle=="isgoogle") {
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

    public function sendPasswordResetLinkEmail(Request $request) {
		$request->validate(['email' => 'required|email']);

		$status = Password::sendResetLink(
			$request->only('email')
		);

		if($status === Password::RESET_LINK_SENT) {
			return response()->json(['message' => __($status)], 200);
		} else {
			throw ValidationException::withMessages([
				'email' => __($status)
			]);
		}
	}

	public function resetPassword(Request $request) {
		$request->validate([
			'token' => 'required',
			'email' => 'required|email',
			'password' => 'required|min:8|confirmed',
		]);

		$status = Password::reset(
			$request->only('email', 'password', 'password_confirmation', 'token'),
			function ($user, $password) use ($request) {
				$user->forceFill([
					'password' => Hash::make($password)
				])->setRememberToken(Str::random(60));

				$user->save();

				event(new PasswordReset($user));
			}
		);

		if($status == Password::PASSWORD_RESET) {
			return response()->json(['message' => __($status)], 200);
		} else {
			throw ValidationException::withMessages([
				'email' => __($status)
			]);
		}
	}

    public function mailtest(Request $request)
    {
        $user=User::firstWhere('email',$request->email);
        if ($user!=null) {
            Mail::to($request->email)->send(new \App\Mail\ResetPassword(['nama'=>$user->name]));
            $respon = [
                'status' => 'success',
                'msg' => 'Email berhasil terkirim ',
                'data' => null,
            ];
            return response()->json($respon, 200);
        }else{

        }
    }
}
