<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class NotificationsController extends Controller
{
    public function markRead($id)
    {
    	$user = User::find($id);

    	$user->unreadNotifications->markAsRead();

    	return back();
    }
}
