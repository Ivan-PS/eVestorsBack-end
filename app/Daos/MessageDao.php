<?php

namespace App\Daos;
use App\Models\Messages;
class MessageDao
{
    public function create($from_id, $to_id, $message){
        return Messages::create([
            "from_id"=> $from_id,
            "to_id" => $to_id,
            "message" => $message
        ]);
    }

    public function getByFromIdAndToId($from_id, $to_id)
    {
        // return Messages::where([["from_id", $from_id], ["to_id", $to_id]])->orWhere([["from_id", $to_id],["to_id", $from_id]]);
        $messages1 = Messages::where("from_id", $from_id)->where("to_id", $to_id)->get();
        $messages2 = Messages::where("to_id", $from_id)->where("from_id", $to_id)->get();
        $messages = $messages1->merge($messages2)->sortBy("created_at");
        $messages_toSend = [];
        foreach ($messages as $message) {
            array_push($messages_toSend, $message);
        }
        return $messages_toSend;

    }
}
