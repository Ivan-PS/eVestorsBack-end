<?php

namespace App\Services;

use App\Daos\FolderDao;
use App\Daos\PermisionDao;
use App\Models\Permision;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\File;

class FolderService
{
    protected $folderDao;
    protected $permisionDao;

    public function __construct(FolderDao $folderDao, PermisionDao $permisionDao)
    {

        $this->folderDao = $folderDao;
        $this->permisionDao = $permisionDao;
    }

    public function createFolder($user_id, $name, $descripton, $parent, $path, $startup_id)  {
       $this->createFolderOnServer($user_id, $name, $startup_id);
       $folder =  $this->folderDao->create($user_id, $name, $descripton, $parent, $path, $startup_id);
       return $this->permisionDao->create($user_id, $folder->id, 1);

    }

    public function createFolderOnServer($user_id, $name, $startup_id){
        if ($startup_id == 0){
                $pathStr = "User/".strval($user_id);
            }
            else{
                $pathStr = "StartUp/".strval($startup_id);
            }
            $pathStr = $pathStr."/".strval($name);

        $folderPath = public_path($pathStr);
        if (!File::isDirectory($folderPath)) {
            File::makeDirectory($folderPath, 0777, true, true);
            return true;
        } else {
            return false;
        }

    }

    public function getById($id){
        return $this->folderDao->getById($id);
    }

    public function getByParent($parent, $startup_id)
    {
        $folder = $this->folderDao->getByParent($parent, $startup_id);
        return $folder;
    }

    public function getFoldersByIdUserWithPermisions($idUser, $parent, $startup_id){
        $folders = $this->getByParent($parent, $startup_id);
        $foldersAllowed = [];

        Log::debug($folders);
        Log::debug("id user: ".str($idUser));
        foreach ($folders as  $folder) {
            $permisionsInFolder = $this->permisionDao->getPermisionByItemAndType($folder->id, 1);
            foreach ($permisionsInFolder as $permisionInFolder) {
                if($permisionInFolder->user_id == $idUser){
                    array_push($foldersAllowed, $folder);
                }
            }
        }
        return $foldersAllowed;
    }

    public function deleteById($id)
    {
        $folder = $this->folderDao->deleteById($id);
        return $folder;
    }

    public function createPermisionsToAllFoldersFromStartup($user_id, $startup_id){
        $folders = $this->folderDao->getFoldersByStartUpId($startup_id);
        foreach ($folders as $folder){
            return Permision::create([
                "user_id"=> $user_id,
                "item_id"=> $folder->id,
                "type" => 1
            ]);
        }
        return $folders;
    }

}
