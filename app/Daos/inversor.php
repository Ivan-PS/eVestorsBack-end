<?php

namespace App\Daos;

use App\Models\Inversor;
use Illuminate\Support\Facades\Log;

class InversorDao
{
    public function create($owner_id, $description, $name)
    {

        $inversor = Inversor::create([
            "owner_id"=> $owner_id,
            "name"=> $name,
            "description"=> $description
        ]);

        return $inversor;

    }

    public function deleteById($id){

        $inversor = Inversor::where('id', $id)->delete();

        return $inversor;

    }

    public function getByOwnerId($owner_id){
        $inversor = Inversor::where('owner_id', $owner_id)->get();

        return $inversor;
    }

    public function updateById($id, $owner_id, $description, $name)
    {
        $inversor = Inversor::where('id', $id)->update([
            "owner_id"=> $owner_id,
            "name"=> $name,
            "description"=> $description
        ]);
        return $inversor;
    }

}
