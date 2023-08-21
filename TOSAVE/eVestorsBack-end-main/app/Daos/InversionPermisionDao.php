<?php

namespace App\Daos;

use App\Models\InversionPermision;
use Illuminate\Support\Facades\Log;

class InversionPermisionDao
{
    public function create($user_id, $startup_id, $percent)
    {

        $inversion_permision = InversionPermision::create([
            "user_id"=> $user_id,
            "startup_id"=> $startup_id,
            "percent" => $percent
        ]);

        return $inversion_permision;

    }

    public function deleteById($id){

        $inversion_permision = InversionPermision::where('id', $id)->delete();

        return $stainversion_permisionrtup;

    }

    public function getByStartup_id($startup_id){
        $inversion_permision = InversionPermision::where('startup_id', $startup_id)->get();
        return $inversion_permision;
    }

    public function getByUser_id($user_id){
        Log::debug($user_id);
        $inversion_permision = InversionPermision::where('user_id', $user_id)->get();
        return $inversion_permision;
    }


    public function updateById($id, $user_id, $startup_id, $percent)
    {
        $inversion_permision = InversionPermision::where('id', $id)->update([
            "user_id"=> $user_id,
            "startup_id"=> $startup_id,
            "percent"=>$percent
        ]);
        return $inversion_permision;
    }

}
