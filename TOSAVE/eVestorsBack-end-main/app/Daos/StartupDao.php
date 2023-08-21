<?php

namespace App\Daos;

use App\Models\Startup;
use Illuminate\Support\Facades\Log;

class StartupDao
{
    public function create($owner_id, $description, $name)
    {

        $startup = Startup::create([
            "owner_id"=> $owner_id,
            "name"=> $name,
            "description"=> $description
        ]);

        return $startup;

    }

    public function getById($id){
        $startup = Startup::where('id', $id)->first();
        return $startup;
    }
    public function deleteById($id){

        $startup = Startup::where('id', $id)->delete();

        return $startup;

    }

    public function getByOwnerId($owner_id){
        $startup = Startup::where('owner_id', $owner_id)->get();

        return $startup;
    }

    public function updateById($id, $owner_id, $description, $name)
    {
        $startup = Startup::where('id', $id)->update([
            "owner_id"=> $owner_id,
            "name"=> $name,
            "description"=> $description
        ]);
        return $startup;
    }

}
