<?php

namespace App\Daos;

use App\Models\File;
use Illuminate\Support\Facades\Log;

class FileDao
{
    public function create($user_id, $name, $parent, $path)
    {

        $file = File::create([
            "user_id" =>$user_id,
            "name"=> $name,
            "description"=> $description,
            "parent"=> $parent,
            "path"=> $path,
            "startup_id"=>$startup_id
        ]);

        return $file;
    }

    public function getById($id)
    {

        $file = File::where('id', $id)->get();
        return $file;
    }

    public function getByParent($parent)
    {


        $file = File::where('parent', $parent)->get();
        return $file;

    }

    public function deleteById($id)
    {
        $file = File::where('id', $id)->delete();
        return $file;
    }

}
