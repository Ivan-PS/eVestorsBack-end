<?php

namespace App\Services;
use App\Daos\NewDao;
use Illuminate\Support\Facades\Log;

class NewService
{

    protected $newDao;

    public function __construct(NewDao $newDao)
    {
        $this->newDao = $newDao;
    }

    public function createNew($title, $description, $image){
        return $this->newDao->create($title, $description, "");
    }
    public function updateNewById($id, $title, $description, $image_path){
        return $this->newDao->updateById($id, $title, $description, "");
    }

    public function getAll()
    {
        return $this->newDao->getAll();
    }

    public function getById($id)
    {
        return $this->newDao->getById($id);
    }

    public function deleteById($id)
    {
        return $this->newDao->deleteById($id);
    }






}
