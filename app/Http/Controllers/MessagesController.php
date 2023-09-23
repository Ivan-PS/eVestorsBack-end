<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MessageService;
class MessagesController extends Controller
{

    protected $messageService;
    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;

    }

    public function createMessage(Request $request)
    {
        $from_id = $request->from_id;
        $to_id = $request->to_id;
        $message = $request->message;


        $response = $this->messageService->createMessage($from_id, $to_id, $message);

        return response()->json([
            'message' => "CreateMessage",
            'response' => $response,
        ], 200);

    }

    public function getMessage(Request $request)
    {
        $from_id = $request->from_id;
        $to_id = $request->to_id;

        $response = $this->messageService->getByFromIdAndToId($from_id, $to_id);
        // $response2 = $this->messageService->getByFromIdAndToId($to_id, $from_id);

        /* $response = [];

        foreach ($response1 as $item1) {
            array_push($response, $item1);
        }
        foreach ($response2 as $item2) {
            array_push($response, $item2);
        }*/



        return response()->json([
            'message' => "getMessages",
            'response' => $response,
        ], 200);

    }

    public function sendFbMessage(Request $request){
        $token = $request->token;
        $this->messageService->sendFbMessage($token, "message");
    }
    public function updateFbToken(Request $request){
        $token = $request->token;
        $user_id = $request->userId;
        $response = $this->messageService->updateFbToken($user_id, $token);
        return response()->json([
            'message' => "update fb token",
            'response' => $response,
        ], 200);
    }
}
