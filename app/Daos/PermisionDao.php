<?php

namespace App\Daos;

use App\Models\Permision;
use Illuminate\Support\Facades\Log;

class PermisionDao
{
    public function create($user_id, $item_id, $type)
    {

        $permision = Permision::create([
            "user_id"=> $user_id,
            "item_id"=> $item_id,
            "type" => $type
        ]);

        return $permision;
    }

    public function getIfPermisionUserFolder($user_id, $item_id)
    {

        $permision = Permision::where('user_id', $user_id)->where('item_id', $item_id)->where('type', 1)->get();
        return $permision;
    }

    public function getIfPermisionUserFile($user_id, $item_id)
    {

        $permision = Permision::where('user_id', $user_id)->where('item_id', $item_id)->where('type', 2)->get();
        return $permision;
    }
    public function deleteById($id)
    {
        $permision = Permision::where('id', $id)->delete();
        return $permision;
    }


    public function getPermisionByItem($item_id){
        $permision = Permision::where('item_id', $item_id)->get();
        return $permision;
    }

    public function getPermisionByItemAndType($item_id, $type){
        $permision = Permision::where('item_id', $item_id)->where("type", $type)->get();
        return $permision;
    }



}
