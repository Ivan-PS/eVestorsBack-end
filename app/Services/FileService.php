<?php

namespace App\Services;

use App\Daos\FileDao;
use Illuminate\Support\Facades\Log;

class FileService
{
    protected $fileDao;

    public function __construct(FileDao $fileDao)
    {
        $this->fileDao = $fileDao;
    }

    public function createFile($user_id, $name, $parent, $path)  {
        return $this->fileDao->create($user_id, $name, $parent, $path);
    }

    public function getById($id){
        return $this->fileDao->getById($id);
    }

    public function getByParent($parent)
    {

        $file = $this->fileDao->getByParent($parent);
        return $file;

    }

    public function deleteById($id)
    {
        $file = $this->fileDao->deleteById;
        return $file;
    }

}
