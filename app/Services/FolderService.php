<?php

namespace App\Services;

use App\Daos\FolderDao;
use App\Daos\PermisionDao;
use Illuminate\Support\Facades\Log;

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
        $folder =  $this->folderDao->create($user_id, $name, $descripton, $parent, $path, $startup_id);
        $this->permisionDao->create($user_id, $folder->id, 1);
        return $folder;
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

        foreach ($folders as  $folder) {
            $permisionsInFolder = $this->permisionDao->getPermisionByItem($folder->id);
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
        $folder = $this->folderDao->deleteById;
        return $folder;
    }

}
