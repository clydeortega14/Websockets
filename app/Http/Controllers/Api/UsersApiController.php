<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Users;
use App\User;
use Illuminate\Support\Facades\DB;
use Hash;

class UsersApiController extends Controller
{
	public function index()
	{
    	return response()->json(User::all());
	}
	public function store(Request $request)
	{

		DB::beginTransaction();

		try {
			
			$user = User::create([

				'name' => $request->name,
				'email' => $request->email,
				'password' => Hash::make($request->password),
				'api_token' => str_random(60),
			]);

		} catch (Exception $e) {
			
			DB::rollback();

			return response()->json($e->getMessage());
		}

		DB::commit();

		// return new Users($user);
		return response()->json($user);
	}
	public function edit($id)
	{
		return new Users(User::findOrFail($id));
	}
	public function update(Request $request, $id)
	{
		DB::beginTransaction();

		$user = User::findOrFail($id);

		try {

			$user = User::where('id', $id)->update([

				'name' => $request->name,
				'email' => $request->email,
				'password' => isset($request->password) ? Hash::make($request->password) : $user->password

			]);
			
		} catch (Exception $e) {
			
			DB::rollback();

			return response()->json($e->getMessage());
		}

		DB::commit();

		return response()->json('Successfully Updated');
	}
	public function destroy($id)
	{
		DB::beginTransaction();

		try {

			User::where('id', $id)->delete();
			
		} catch (Exception $e) {
			
			DB::rollback();

			return response()->json($e->getMessage());
		}

		DB::commit();

		return response()->json('successfully Deleted');
	}
}
