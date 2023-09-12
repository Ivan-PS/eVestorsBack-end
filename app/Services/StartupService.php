<?php

namespace App\Services;

use App\Daos\StartupDao;
use App\Daos\StartupPermisionDao;
use App\Daos\AccessCodeDao;
use App\Daos\InversionPermisionDao;
use Illuminate\Support\Facades\Log;

class StartupService
{
    protected $startupDao;
    protected $startUpsPermisionsDao;
    protected $accessCodeDao;
    protected $inversionPermisionDao;

    public function __construct(StartupDao $startupDao, StartupPermisionDao $startUpsPermisionsDao, AccessCodeDao $accessCodeDao, InversionPermisionDao $inversionPermisionDao)
    {
        $this->startupDao = $startupDao;
        $this->startUpsPermisionsDao = $startUpsPermisionsDao;
        $this->accessCodeDao = $accessCodeDao;
        $this->inversionPermisionDao = $inversionPermisionDao;
    }

    public function createStartUp($user_id, $name, $description)  {
        $startUp = $this->startupDao->create($user_id, $name, $description);
        $this->startUpsPermisionsDao->create($user_id, $startUp->id);
        return $startUp;
    }

    public function createStartUpPermision($startup_id, $user_id){
        $this->startUpsPermisionsDao->create($user_id, $startup_id);
    }

    public function getByUserId($idUser)  {
        Log::debug($idUser);
        $startUpsPermisions = $this->startUpsPermisionsDao->getByUser_id($idUser);
        $startUpsAllowed = [];
        Log::debug(strval($startUpsPermisions));
        foreach ($startUpsPermisions as  $startUpsPermision) {
            if($startUpsPermision->user_id == $idUser){
                $startUp = $this->startupDao->getById($startUpsPermision->startup_id);
                array_push($startUpsAllowed, $startUp);
            }

        }
        return $startUpsAllowed;
    }


    public function checkAndUseIfValid($user_id, $startup_id, $accessCode){

        $accessCodeDB = $this->accessCodeDao->getByAccessCode($accessCode);
        if($accessCode != null){
            if($startup_id == $accessCodeDB->startup_id){

                return true;

            }
        }
        return false;
    }

    public function createInversor($user_id, $startup_id, $percent){
        return $this->inversionPermisionDao->create($user_id, $startup_id, $percent);
    }

    public function getInversorsAllowedByStartUpId($startup_id){
        $inversionPermisions = $this->inversionPermisionsDao->getByStartup_id($startup_id);
        $inversiorsAllowed = [];

        foreach ($inversionPermisions as  $inversionPermision) {
            $user = $this->userDao->getById($inversionPermision->user_id);
            array_push($inversiorsAllowed, $user);
        }
        return $inversiorsAllowed;
    }

    public function generateAccessCode($startup_id){
        $accesCode = rand(1000,9999);
        return $this->accessCodeDao->create($startup_id,$accesCode);
    }

    public function getAccessCodeByStartUpId($startup_id){
        return $this->accessCodeDao->getByStartUpId($startup_id);
    }

    public function checkAccessCode($user_id, $accessCode){

        $result = $this->accessCodeDao->getByAccessCode($accessCode);
        Log::debug($accessCode);
        if($result != null){
            $startup_id = $result->startup_id;
            $percent = 0;
            return $this->createInversor($user_id, $startup_id, $percent);
        }
        return null;
    }

}
