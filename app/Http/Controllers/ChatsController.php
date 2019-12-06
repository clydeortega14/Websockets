<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Events\SendMessage;

class ChatsController extends Controller
{

	public function index()
	{
		return view('chat.chat');
	}

	public function sendMessage(Request $request)
	{
		$user = auth()->user();

		DB::beginTransaction();

		try {


			$message = $user->messages()->create([

				'message' => $request->input('message')
			]);
			
		} catch (Exception $e) {
			
			DB::rollback();

			return response()->json($e->getMessage());
		}

		DB::commit();

		$message = Message::where('id', $message->id)->with('user')->first();
		broadcast(new SendMessage($message))->toOthers();
		return response()->json($message);

	}
    public function getMessage()
    {
    	return Message::with('user')->get();
    }
}
