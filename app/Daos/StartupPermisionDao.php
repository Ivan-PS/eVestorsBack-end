<?php

namespace App\Daos;

use App\Models\StartupPermision;
use Illuminate\Support\Facades\Log;

class StartupPermisionDao
{


    public function create($user_id, $startup_id, $percent)
    {

        $startup_permision = StartupPermision::create([
            "user_id"=> $user_id,
            "startup_id"=> $startup_id,
            "percent" =>$percent
        ]);

        return $startup_permision;

    }

    public function deleteById($id){

        $startup_permision = StartupPermision::where('id', $id)->delete();

        return $startup_permision;

    }

    public function getByStartup_id($startup_id){
        $startup_permision = StartupPermision::where('startup_id', $startup_id)->get();
        return $startup_permision;
    }

    public function getByUser_id($user_id){
        Log::debug(strval($user_id));
        $startup_permision = StartupPermision::where('user_id', $user_id)->get();
        return $startup_permision;
    }


    public function updateById($id, $user_id, $startup_id)
    {
        $startup_permision = StartupPermision::where('id', $id)->update([
            "user_id"=> $user_id,
            "startup_id"=> $startup_id
        ]);
        return $startup_permision;
    }

}
