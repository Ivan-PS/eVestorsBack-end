<?php

namespace App\Services;

use App\Daos\MessageDao;
use App\Daos\UserDao;
use Illuminate\Support\Facades\Log;
use function PHPUnit\TestFixture\func;

class MessageService
{
    protected $messageDao;
    protected  $userDao;

    public function __construct(MessageDao $messageDao, UserDao $userDao)
    {
        $this->messageDao = $messageDao;
        $this->userDao = $userDao;
    }

    public function createMessage($from_id, $to_id, $message){
        $toUser = $this->userDao->getById($to_id);
        $fromUser = $this->userDao->getById($from_id);
        Log::info("SEND TO USER: ".strval($toUser));
        if($toUser->fbToken != ""){
            $this->sendFbMessage($fromUser, $toUser->fbToken ,$message, "message");
        }
        return $this->messageDao->create($from_id, $to_id, $message);
    }

    public function getByFromIdAndToId($from_id, $to_id){
        return $this->messageDao->getByFromIdAndToId($from_id, $to_id);
    }

    public function sendFbMessage($toUser, $token, $message, $type)
    {
        Log::info("send message token: ".$token);
        $messageToSend = [];
        $messageToSend["type"] = $type;
        $messageToSend["toUser"] = $toUser->id;
        $messageToSend["message"] = $message;
        // $token = $toUser->fbToken;
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $headers = [
            'authorization: key=AAAASAXqLrE:APA91bF8hBCAnXMsCEh-UvZlEGC8iRGdRsKPehfVkjHbi8zvOLXqt98IpHg7NxDWbQPtYr_mVfayrp3NT00awfI20jeMQNgNxOOdoHliCGONpH4ygEV2smhcYpPwZayTtLLZigRBqrWe',
            'content-type: application/json'
        ];
        $notification = [
            'title' => "Notificacion de test",
            'body' => $messageToSend
        ];

        $fcmNotification = [
            'to' => $token,
            'notification' => $notification,
            'priority' => "high",
            'data' => ["message" => $message, "type" =>$type, "toUser" => $toUser->id]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);
        Log::info($result);
    }

    public function updateFbToken($user_id, $tokenFb)
    {
        return $this->userDao->updateFbToken($user_id, $tokenFb);
    }
}


