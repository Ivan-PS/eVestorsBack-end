<?php

namespace App\Daos;

use App\Models\Events;

class EventsDao
{
    public function create($name, $description, $date)
    {

        return Events::create([
            "name" =>$name,
            "description"=> $description,
            "date" => $date
        ]);
    }



}
