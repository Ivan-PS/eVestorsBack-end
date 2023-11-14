<?php

namespace App\Services;

use App\Daos\StartupDao;
use App\Daos\StartupPermisionDao;
use App\Daos\AccessCodeDao;
use App\Daos\InversionPermisionDao;

use App\Daos\UserDao;
use Illuminate\Support\Facades\Log;

class StartupService
{
    protected $startupDao;
    protected $startUpsPermisionsDao;
    protected $accessCodeDao;
    protected $inversionPermisionDao;
    protected $userDao;

    public function __construct(StartupDao $startupDao, StartupPermisionDao $startUpsPermisionsDao, AccessCodeDao $accessCodeDao, InversionPermisionDao $inversionPermisionDao, UserDao $userDao)
    {
        $this->startupDao = $startupDao;
        $this->startUpsPermisionsDao = $startUpsPermisionsDao;
        $this->accessCodeDao = $accessCodeDao;
        $this->inversionPermisionDao = $inversionPermisionDao;
        $this->userDao = $userDao;
    }

    public function getById($id)
    {


        $startup = $this->startupDao->getById($id);
        $startup["owners"] = $this->getFoundersAllowedByStartUpId($id);
        $startup["inversors"] = $this->getInversorsAllowedByStartUpId($id);
        return $startup;
    }

    public function createStartUp($user_id, $name, $description)  {
        $startUp = $this->startupDao->create($user_id, $name, $description);
        $this->startUpsPermisionsDao->create($user_id, $startUp->id, 0);
        return $startUp;
    }

    public function updateById($startup_id, $name, $description)
    {

        $startup = $this->startupDao->updateById($startup_id, $name, $description);
        $startup["owners"] = $this->getFoundersAllowedByStartUpId($startup_id);
        $startup["inversors"] = $this->getInversorsAllowedByStartUpId($startup_id);
        return $startup;
    }

    public function createStartUpPermision($startup_id, $user_id, $percent){
        $this->startUpsPermisionsDao->create($user_id, $startup_id, $percent);
    }

    public function getByUserId($idUser)  {
        Log::debug($idUser);
        $startUpsPermisions = $this->startUpsPermisionsDao->getByUser_id($idUser);
        $startUpsAllowed = [];
        Log::debug(strval($startUpsPermisions));
        foreach ($startUpsPermisions as  $startUpsPermision) {
            if($startUpsPermision->user_id == $idUser){
                $startUp = $this->startupDao->getById($startUpsPermision->startup_id);
                $startUp["owners"] = $this->getFoundersAllowedByStartUpId($startUp->id);
                $startUp["inversors"] = $this->getInversorsAllowedByStartUpId($startUp->id);

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
        $inversionPermisions = $this->inversionPermisionDao->getByStartup_id($startup_id);
        $inversiorsAllowed = [];

        foreach ($inversionPermisions as  $inversionPermision) {
            $user = $this->userDao->getById($inversionPermision->user_id);
            $user["percent"] = $inversionPermision->percent;
            array_push($inversiorsAllowed, $user);
        }
        return $inversiorsAllowed;
    }

    public function getFoundersAllowedByStartUpId($startup_id){
        $inversionPermisions = $this->startUpsPermisionsDao->getByStartup_id($startup_id);
        $inversiorsAllowed = [];

        foreach ($inversionPermisions as  $inversionPermision) {
            $user = $this->userDao->getById($inversionPermision->user_id);
            $user["percent"] = $inversionPermision->percent;

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
