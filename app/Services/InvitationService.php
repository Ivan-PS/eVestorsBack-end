<?php

namespace App\Services;

use App\Daos\InversorDao;
use App\Daos\InvitationDao;
use App\Daos\UserDao;
use Illuminate\Support\Facades\Log;


class InvitationService
{

    protected $invitationDao;
    protected  $folderService;
    protected $fileService;
    protected  $startUpService;
    protected $userDao;

    public function __construct(InvitationDao $invitationDao, FileService $fileService, FolderService $folderService, StartupService $startupService, UserDao $userDao)
    {
        $this->invitationDao = $invitationDao;
        $this->fileService = $fileService;
        $this->folderService = $folderService;
        $this->startUpService = $startupService;
        $this->userDao = $userDao;
    }

    public function createInvitation($from_user, $startup_id, $to_user, $type){
        if($this->checkIfExistInvitation($to_user, $startup_id) == True){
            return False;
        }
        $invitation = $this->invitationDao->createInvitation($from_user, $startup_id, $to_user, $type);
        $invitation["fromUser"] = $this->userDao->getById($invitation->from_user);
        $invitation["toUser"] = $this->userDao->getById($invitation->to_user);
        $start_up = $this->startUpService->getById($invitation->startup_id);
        $invitation["startUp"] = $start_up;
        return $invitation;
    }
    public function getAll()
    {
        return $this->invitationDao->getAll();
    }

    public function getById($id)
    {
        return $this->invitationDao->getById($id);
    }

    public function deleteById($id)
    {
        $invitation = $this->invitationDao->deleteById($id);
    }


    public function getByUserId($user_id)
    {

        $invitations =  $this->invitationDao->getByUserId($user_id);
        foreach ($invitations as $invitation) {
            $invitation["fromUser"] = $this->userDao->getById($invitation->from_user);
            $invitation["toUser"] = $this->userDao->getById($invitation->to_user);
            $start_up = $this->startUpService->getById($invitation->startup_id);
            $invitation["startUp"] = $start_up;
        }
        return $invitations;
    }

    public function getByStartUpId($startup_id)
    {

        $invitations =  $this->invitationDao->getByStartUpId($startup_id);
        foreach ($invitations as $invitation) {
            $invitation["fromUser"] = $this->userDao->getById($invitation->from_user);
            $invitation["toUser"] = $this->userDao->getById($invitation->to_user);
            $start_up = $this->startUpService->getById($invitation->startup_id);
            $invitation["startUp"] = $start_up;
        }
    
        return $invitations;
    }

    public function acceptInvitation($invitation_id, $startup_id, $user_id, $type)
    {
        Log::debug("ON INVITATION TYPE". strval($type));
        if ($type == strval("1")){
            
            $this->startUpService->createStartUpPermision($startup_id, $user_id, 0);
        }
        else if($type ==  strval("2")){
            return $this->startUpService->createInversor($user_id, $startup_id, 0);
        }
        $this->folderService->createPermisionsToAllFoldersFromStartup($user_id, $startup_id);
        $this->fileService->createPermisionsToAllFilesFromStartup($user_id, $startup_id);
        $invitation =  $this->invitationDao->deleteById($invitation_id);

        $invitation["fromUser"] = $this->userDao->getById($invitation->from_user);
        $invitation["toUser"] = $this->userDao->getById($invitation->to_user);
        $start_up = $this->startUpService->getById($invitation->startup_id);
        $invitation["startUp"] = $start_up;
        return $invitation;
    }
    public function addStartUpInfo($invitations){
        foreach ($invitations as $invitation){
            $start_up = $this->startUpService->getById($invitation->startup_id);
            $invitation["startUp"] = $start_up;
        }
        return $invitations;
    }



    function checkIfExistInvitation($user, $startUp_id){
        $invitations = $this->getByStartUpId($startUp_id);
        foreach($invitations as $invitation){
            if($invitation->to_user == $user){
                return True;
            }
        }
        return False;
    }



}
