<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use App\Services\InvitationService;
use Illuminate\Support\Facades\Log;

class InvitationsController extends Controller
{
    protected $invitationService;
    protected $userService;
    public function __construct(InvitationService $invitationService, UserService $userService)
    {
        $this->invitationService = $invitationService;
        $this->userService = $userService;
    }

    public function create(Request $request)
    {
        $token = $request->token;
        $from_user = $this->userService->getUserBySession($token);
        $from_id = $from_user->id;
        $startup_id = $request->startup_id;
        $to_email = $request->to_email;
        $type = $request->type;
        $getUserByEmail = $this->userService->getByEmail($to_email);



        if ($getUserByEmail != null){
            if ($type == $getUserByEmail->type) {
                return response()->json([
                    'message' => "create invitation",
                    'response' => $this->invitationService->createInvitation($from_id, $startup_id, $getUserByEmail->id, $type)
                ], 200);
            }

            return response()->json([
                'message' => "El usuario no es ". (($type == 1) ? "fundador": "inversor"),
                'response' => []
            ], 402);

        }

        return response()->json([
            'message' => "not found mail",
            'response' => []
        ], 402);

    }

    public function getAll(Request $request)
    {
        return response()->json([
            'message' => "get all inivtations",
            'response' => $this->invitationService->getAll()
        ], 200);
    }

    public function getById(Request $request)
    {
        $id = $request->id;
        return response()->json([
            'message' => "get invitations by id",
            'response' => $this->invitationService->getById($id)
        ], 200);

    }

    public function deleteById(Request $request)
    {
        $id = $request->id;

        return response()->json([
            'message' => "delete by id",
            'response' => $this->invitationService->deleteById($id)
        ], 200);

    }

    public function getByUserId(Request $request)
    {
        $token = $request->token;
        $user = $this->userService->getUserBySession($token);
        $user_id = $user->id;
        Log::debug(strval($token));
        return response()->json([
            'message' => "get inivtations by user id",
            'response' => $this->invitationService->getByUserId($user_id)
        ], 200);
    }

    public function getByStartupId(Request $request)
    {

        $user_id = $request->startup_id;
        return response()->json([
            'message' => "get inivtations by startup_id",
            'response' => $this->invitationService->getByStartUpId($user_id)
        ], 200);
    }

    public function acceptInvitation(Request $request)
    {
        $invitation_id = $request->invitation_id;
        Log::debug("Invitation ".$invitation_id, );

        $invitation = $this->invitationService->getById($invitation_id);
        $startup_id = $invitation->startup_id;
        $user_id = $invitation->to_user;
        $type = $invitation->type;
        $res = $this->invitationService->acceptInvitation($invitation_id, $startup_id, $user_id, $type);
        return response()->json([
            'message' => "accepted invitation",
            'response' => $res
        ], 200);
    }
}
