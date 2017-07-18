<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Messages;
use App\Events\RedisEvent;
use Redis;

class RedisController extends Controller
{
    public function index(){
    	$messages = Messages::all();

    	return view('chat',compact('messages'));
    }

    public function postSendMessages(Request $request)
    {
    	$messages = Messages::create($request->all());
    	event(
    		$e =  new RedisEvent($messages)
    	);
    	return redirect()->back();
    }
}
