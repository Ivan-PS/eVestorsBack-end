<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StartupAccessCodesController extends Controller
{
    protected $startupService;

    public function __construct(StartupService $startupService)
    {
        $this->startupService = $startupService;
    }
    public function create(Request $request){
        $startup_id = $request->startup_id;
        $accessCode = $this->startupService->createAccessCode($startup_id);
        return response()->json([
                'message' => "created accessCode",
                'response' => $accessCode,
            ], 200);
    }

    public function createInversor(Request $request){
        $startup_id = $request->startup_id;
        $user_id = $request->user_id;
        $accessCode = $request->accessCode;
        $check = $this->startupService->checkAndUseIfValid($user_id, $startup_id, $accessCode);
        if($check == true){
            $inversor = $this->startupService->createInversor($user_id, $startup_id, 0);
            return response()->json([
                'message' => "created accessCode",
                'response' => $inversor,
            ], 200);
            
        }
        return response()->json([
                'message' => "created accessCode",
                'response' => false
        ]);
    }
}
