<?php

namespace App\Daos;

use App\Models\Folder;
use Illuminate\Support\Facades\Log;

class FolderDao
{
    public function create($user_id, $name, $description, $parent, $path, $startup_id)
    {

        $folder = Folder::create([
            "user_id" =>$user_id,
            "name"=> $name,
            "description"=> $description,
            "parent"=> $parent,
            "path"=> "/",
            'startup_id' => $startup_id
        ]);

        return $folder;
    }

    public function getById($id)
    {

        $folder = Folder::where('id', $id)->get();
        return $folder;
    }

    public function getByParent($parent, $startup_id)
    {
        $folder = Folder::where('parent', $parent)->where('startup_id', $startup_id)->get();
        Log::debug("STARTUP ID ON GET FOLDER: ". strval($startup_id));
        return $folder;
    }

    public function getFoldersWithPermision($parent, $user_id) {

    }    



    public function deleteById($id)
    {
        $folder = Folder::where('id', $id)->delete();
        return $folder;
    }

}
