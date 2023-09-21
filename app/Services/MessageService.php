<?php

namespace App\Services;

use App\Daos\MessageDao;

class MessageService
{
    protected $messageDao;

    public function __construct(MessageDao $messageDao)
    {
        $this->messageDao = $messageDao;
    }

    public function createMessage($from_id, $to_id, $message){
        return $this->messageDao->create($from_id, $to_id, $message);
    }

    public function getByFromIdAndToId($from_id, $to_id){
        return $this->messageDao->getByFromIdAndToId($from_id, $to_id);
    }
}
