<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller
{

  //fungsi untuk register
  public function Register(Request $request){

    $this->validate($request, [
        'username' => 'required|unique:users',
        'email' => 'required|unique:users',
        'password' => 'required',
        'repassword' => 'required|same:password',
    ]);

    //fungsi balikan user create
    return User::create([
        'username' => $request->json('username'),
        'email' => $request->json('email'),
        'password' => bcrypt($request->json('password'))
      ]);

    }

    //fungsi untuk login
    public function Login(Request $request){

      $this->validate($request, [
        'email' => 'required|max:100',
        'password' => 'required|max:100',
      ]);
          //ambil email dan password
          $credentials = $request->only('email','password');
            try {

                if (! $token = JWTAuth::attempt($credentials)) {
                  //jika error verifikasi credentials dan create token untuk user
                  return response()->json(['error' => 'invalid_email_and_password'], 401);
                }
            } catch (JWTException $e) {
              //jika error dalam encode token
              return response()->json(['error' => 'could_not_create_token'],500);
            }


            return response()->json([
                "user_id" => $request->user()->id,
                "username" => $request->user()->username,
                "token" => $token
            ]);
    }

}
