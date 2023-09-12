<?php

namespace App\Daos;

use App\Models\File;
use Illuminate\Support\Facades\Log;

class FileDao
{
    public function create($user_id, $folder_id, $startup_id, $path, $name)
    {

        $file = File::create([
            "user_id" =>$user_id,
            "name"=> $name,
            "folder_id"=> $folder_id,
            "path"=> $path,
            "startup_id"=>$startup_id
        ]);

        return $file;
    }

    public function getById($id)
    {

        $file = File::where('id', $id)->first();
        return $file;
    }

    public function getByParent($parent, $startup_id)
    {


        $file = File::where('folder_id', $parent)->where('startup_id', $startup_id)->get();
        return $file;

    }

    public function deleteById($id)
    {
        $file = File::where('id', $id)->delete();
        return $file;
    }

}
