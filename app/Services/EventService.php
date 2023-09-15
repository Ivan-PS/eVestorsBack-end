<?php

namespace App\Services;
use App\Daos\EventsDao;
use Illuminate\Support\Facades\Log;

class EventService
{

    protected $eventsDao;

    public function __construct(EventsDao $eventsDao)
    {
        $this->eventsDao = $eventsDao;
    }

    public function createEvent($name, $description, $date){


    }






}
