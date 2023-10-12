<?php

namespace App\Services;

use App\Daos\InversorDao;
use App\Daos\InvitationDao;
use Illuminate\Support\Facades\Log;


class InvitationService
{

    protected $invitationDao;
    protected  $folderService;
    protected $fileService;
    protected  $startUpService;

    public function __construct(InvitationDao $invitationDao, FileService $fileService, FolderService $folderService, StartupService $startupService)
    {
        $this->invitationDao = $invitationDao;
        $this->fileService = $fileService;
        $this->folderService = $folderService;
        $this->startUpService = $startupService;
    }

    public function createInvitation($from_user, $startup_id, $to_user, $type){
        return $this->invitationDao->createInvitation($from_user, $startup_id, $to_user, $type);
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
        return $this->invitationDao->deleteById($id);
    }

    public function getByUserId($user_id)
    {
        return $this->invitationDao->getByUserId($user_id);
    }

    public function getByStartUpId($startup_id)
    {
        return $this->invitationDao->getByStartUpId($startup_id);
    }

    public function acceptInvitation($startup_id, $user_id, $type)
    {
        if ($type == 1){
            $this->startUpService->createStartUpPermision($startup_id, $user_id);
        }
        else if($type == 2){
            return $this->startUpService->createInversor($user_id, $startup_id, 0);
        }
        $this->folderService->createPermisionsToAllFoldersFromStartup($user_id, $startup_id);
        $this->fileService->createPermisionsToAllFilesFromStartup($user_id, $startup_id);
        return $this->invitationDao->deleteById($user_id);
    }
    public function addStartUpInfo($invitations){
        foreach ($invitations as $invitation){
            $start_up = $this->startUpService->getById($invitation->startup_id);
            $invitation["startUp"] = $start_up;
        }
        return $invitations;
    }





}
