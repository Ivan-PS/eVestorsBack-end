<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use App\Services\InvitationService;

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
        $from_id= $request->form_id;
        $startup_id = $request->startup_id;
        $to_email = $request->to_email;

        $getUserByEmail = $this->userService->getByEmail($to_email);

        if ($getUserByEmail != null || $getUserByEmail != null){
            return response()->json([
                'message' => "create invitation",
                'response' => $this->invitationService->createInvitation($from_id, $startup_id, $getUserByEmail->id)
            ], 200);
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

        $user_id = $request->user;
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
}
