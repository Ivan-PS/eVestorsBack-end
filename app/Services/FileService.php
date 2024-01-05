<?php

namespace App\Services;
use App\Daos\StartupDao;
use App\Models\Permision;
use Illuminate\Support\Facades\File;

use App\Daos\FileDao;
use Illuminate\Support\Facades\Log;
use App\Services\FolderService;
use App\Daos\PermisionDao;

class FileService
{
    protected $fileDao;
    protected $folderService;
    private $permisionDao;
    private $startUpDao;

    public function __construct(FileDao $fileDao, FolderService $folderService, PermisionDao $permisionDao, StartupDao $startupDao)
    {
        $this->folderService = $folderService;
        $this->fileDao = $fileDao;
        $this->permisionDao = $permisionDao;
        $this->startUpDao = $startupDao;
    }

    public function createFile($user_id, $folder_id, $startup_id, $path, $name){

        $file = $this->fileDao->create($user_id, $folder_id, $startup_id, $path, $name);
        $this->permisionDao->create($user_id, $file->id, 2);
        return $file;

    }



    public function getById($id){
        return $this->fileDao->getById($id);
    }

    public function getByParent($parent, $startup_id)
    {
        Log::debug("parent: ".str($parent));
        Log::debug("startup: ".str($startup_id));
        $file = $this->fileDao->getByParent($parent, $startup_id);
        Log::debug($file);
        return $file;

    }

    public function deleteById($id)
    {
        $file = $this->fileDao->deleteById;
        return $file;
    }


    public function getFilesByIdUserWithPermisions($idUser, $parent, $startup_id){
        $files = $this->getByParent($parent, $startup_id);
        $filesAllowed = [];

        Log::debug("files");
        Log::debug($files);

        foreach ($files as  $file) {
            Log::debug("user id".strval($idUser));
            $permisionsInFile = $this->permisionDao->getPermisionByItemAndType($file->id, 2);
            Log::debug($permisionsInFile);
            foreach ($permisionsInFile as $permisionInFile) {
                if($permisionInFile->user_id == $idUser){
                    $file->folder = $this->folderService->getById($file->folder_id);
                    array_push($filesAllowed, $file);
                }
            }
        }
        return $filesAllowed;
    }

    public function createPermisionsToAllFilesFromStartup($user_id, $startup_id){
        $files = $this->fileDao->getFilesByStartUpId($startup_id);
        foreach ($files as $file){
            return Permision::create([
                "user_id"=> $user_id,
                "item_id"=> $file->id,
                "type" => 2
            ]);
        }
    }


}
