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
        if(checkAndUseIfValid($user_id) == true){
            return $this->inversionPermisionDao->create($user_id, $startup_id, $percent);
        }
        return false;


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

}
