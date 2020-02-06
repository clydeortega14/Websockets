<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;

class AuthController extends Controller
{

    public function login(Request $request)
    {

        $auth = auth()->attempt(['email' => $request->username, 'password' => $request->password]);

        if(!$auth){

            return response()->json(['status' => false, 'message' => 'Invalid user'], 401);
        }

        $user = User::where('email', $request->username)->first();
        $user_posts = $user->posts;

        $user_data = ["user" => $user, "token" => $this->generateToken($request)];

        return response()->json(['status' => true, 'user_data' => $user_data]);
    }
    public function register(Request $request)
    {

        //check if email already exist
        $email = User::where('email', $request->email)->first();

        if(!is_null($email)){

            return response()->json(['status' => false, 'message' => 'Email already exist']);
        }

        // Begin transaction
        DB::beginTransaction();

        try {

            //Create New User
            $user = $this->createUser($request->toArray());
            
        } catch (Exception $e) {

            DB::rollback();

            return response()->json(['status' => false, 'message' => $e->getMessage() ], 500);
        }

        DB::commit();

        return response()->json(['status' => true, 'message' => 'successfully registered'], 200);
    }

    public function logout()
    {
        auth()->user()->tokens->each(function($token, $key){
            $token->delete();
        });

        return response()->json('Logged Out successfully', 200);    
    }

    public function createUser(Array $data)
    {
        return User::create([

            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'api_token' => str_random(60),

        ]);
    }

    public function generateToken(Request $request)
    {
        try {

            $http = new \GuzzleHttp\Client;

            $response = $http->post(config('services.passport.end_point'), [

                'form_params' => [

                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->username,
                    'password' => $request->password
                ],

            ]);

            return json_decode($response->getBody(), true);
            
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {

            if($e->getCode() == 400){

                return response()->json('Bad Request', $e->getCode());

            }else if($e->getCode() == 401){

                return response()->json('Incorrect Credentials', $e->getCode());

            }else if($e->getCode() == 415){

                return response()->json('Unsupported Media type', $e->getCode());
            }
        }
    }
}
