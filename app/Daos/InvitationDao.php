<?php

namespace App\Daos;

use App\Models\Invitations;
use Illuminate\Support\Facades\Log;

class InvitationDao
{
    public function createInvitation($from_id, $startup_id, $to_id, $type)
    {
        return Invitations::create([
            "from_user" => $from_id,
            "startup_id" => $startup_id,
            "to_user" => $to_id,
            "type" => $type
        ]);
    }

    public function getAll()
    {
        return Invitations::all();
    }

    public function getById($id)
    {
        return Invitations::where("id", $id)->first();
    }

    public function deleteById($id)
    {
        return Invitations::where("id", $id)->delete();
    }
    public function  getByUserId($user_id){
        return Invitations::where("to_user", $user_id)->get();
    }

    public function  getByStartUpId($startup_id){
        return Invitations::where("startup_id", $startup_id)->get();
    }

}
