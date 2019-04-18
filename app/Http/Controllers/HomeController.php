<?php

namespace App\Http\Controllers;

use OpenTok\OpenTok;
use OpenTok\MediaMode;
use OpenTok\ArchiveMode;

use OpenTok\Session;
use OpenTok\Role;

use App\Room;
use App\RoomChat;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	/*public function __construct()
    {
        $this->middleware('auth:api');
    } */

    public function chat(Request $request) 
    {
     	$request->room;
     	$request->teacher;
     	$request->student;

     		if ($request->room != '') {
     			$room_chat = RoomChat::where(['room_id' => $request->room, 'teacher_id' => $request->teacher, 'student_id' => $request->student])->first();

     			if ($room_chat) {
     				$sessionId = $room_chat->session_id;
     			}else{
     				return view('errors.404');
     			}
     		}

           // initialze api using api key/secret
           $openTokAPI = new OpenTok(env('OPENTOK_API_KEY'), env('OPENTOK_API_SECRET'));

           // let's cache the session for an hour i.e. 60 mins
          /* $session_token = \Cache::remember('open_tok_session_key', 60, function () use ($openTokAPI) {             
                return $openTokAPI->createSession(['mediaMode' => MediaMode::ROUTED]);
           });*/

           // Create a session that attempts to use peer-to-peer streaming:
			$session = $openTokAPI->createSession();

			// Store this sessionId in the database for later use
			//$sessionId = $session->getSessionId();
			//$sessionId = '1_MX40NTk5ODg4Mn5-MTU1NTU4ODc2NDEwMX5vTEw4U1dEMFNPSEtqT3UvV3ZsNm1ScG5-UH4';

           // now, that we have session token we generate opentok token
          /* $opentok_token = $openTokAPI->generateToken($session->session_id, [
                'exerciseireTime' => time()+60,
                'data'       => "Some sample metadata to pass"
           ]);*/

           // Generate a Token from just a sessionId (fetched from a database)
			//$token = $openTokAPI->generateToken($sessionId);
			//$token = 'T1==cGFydG5lcl9pZD00NTk5ODg4MiZzaWc9NTFmYmQyMzZlZmE3YWYwMmVmZDUyODY0MjY0NGE1NmMzNTRjZGU1ODpzZXNzaW9uX2lkPTFfTVg0ME5UazVPRGc0TW41LU1UVTFOVFU0T0RnMk5UWTJOSDRyVkhRMFZtWmpURE15YUM5aWQyNVBWSHB1WkVkbWNEWi1VSDQmY3JlYXRlX3RpbWU9MTU1NTU4ODg4OCZyb2xlPXB1Ymxpc2hlciZub25jZT0xNTU1NTg4ODg4LjM5MjMxNzAyNjM5ODU0JmluaXRpYWxfbGF5b3V0X2NsYXNzX2xpc3Q9';

           	// Set some options in a token
           /*if ($request->user == 'guest') {
				$token = $session->generateToken(array(
				    'role'       => Role::PUBLISHER,
				    'expireTime' => time()+(7 * 24 * 60 * 60), // in one week
				    'data'       => 'name=Johnny',
				    'initialLayoutClassList' => array('focus')
				));
			}else*/ if ($request->user == 'host' || $request->user == 'guest') {
				/*$token = $session->generateToken(array(
				    'role'       => Role::MODERATOR,
				    'expireTime' => time()+(7 * 24 * 60 * 60), // in one week
				    'data'       => 'name=Johnny',
				    'initialLayoutClassList' => array('focus')
				));*/
				$token = $openTokAPI->generateToken($sessionId);
			}elseif ($request->user == 'viewer') {
				$token = $session->generateToken(array(
				    'role'       => Role::SUBSCRIBER,
				    'expireTime' => time()+(7 * 24 * 60 * 60), // in one week
				    'data'       => 'name=Johnny',
				    'initialLayoutClassList' => array('focus')
				));
			}

			// Get list of streams from just a sessionId (fetched from a database)
			//$streamList = $openTokAPI->listStreams($sessionId);

			//$count_stream = $streamList->totalCount(); // total count
			if ($request->user == 'guest') {
				return view('chat_guest', [
	              	'session_token' => $sessionId,
	              	'opentok_token' => $token
	           	]);
			}else{
				return view('chat', [
	              	'session_token' => $sessionId,
	              	'opentok_token' => $token
	           	]);
			}
           
     }
}
