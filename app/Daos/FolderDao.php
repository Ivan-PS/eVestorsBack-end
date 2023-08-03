<?php

namespace App\Daos;

use App\Models\Folder;
use Illuminate\Support\Facades\Log;

class FolderDao
{
    public function create($user_id, $name, $parent, $path)
    {

        $folder = Folder::create([
            "user_id" =>$user_id,
            "name"=> $name,
            "description"=> $description,
            "parent"=> $parent,
            "path"=> $path,
        ]);

        return $folder;
    }

    public function getById($id)
    {

        $folder = Folder::where('id', $id)->get();
        return $folder;
    }

    public function getByParent($parent)
    {


        $folder = Folder::where('parent', $parent)->get();
        return $folder;

    }

    public function deleteById($id)
    {
        $folder = Folder::where('id', $id)->delete();
        return $folder;
    }

}