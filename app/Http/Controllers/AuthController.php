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
    	// Generate token
        return $this->generateToken($request);
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'email' => 'email|unique:users'

        ]);

        if($validator->fails()){

            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
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
