<?php

namespace App\Services;
use App\Daos\InversorDao;
use App\Daos\InvitationDao;
use Illuminate\Support\Facades\Log;

class InvitationService
{

    protected $invitationDao;

    public function __construct(InvitationDao $invitationDao)
    {
        $this->invitationDao = $invitationDao;
    }

    public function createInvitation($from_user, $startup_id, $to_user){
        return $this->invitationDao->create($from_user, $startup_id, $to_user);
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






}
