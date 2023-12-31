<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use App\Services\StartupService;
use Illuminate\Support\Facades\Log;

class StartupController extends Controller
{
    protected $startupService;
    protected $userService;

    public function __construct(StartupService $startupService, UserService  $userService)
    {
        $this->startupService = $startupService;
        $this->userService = $userService;
    }
    public function create(Request $request)
    {
        $sesion = $request->token;
        $user = $this->userService->getUserBySession($sesion);
        $user_id = $user->id;

        $name = $request->name;
        $description = $request->description;


        $startup = $this->startupService->createStartup($user_id, $name, $description);
        $startup["owners"] = $this->startupService->getFoundersAllowedByStartUpId($startup->id);
        $startup["inversors"] = $this->startupService->getInversorsAllowedByStartUpId($startup->id);

        return response()->json([
                'message' => "created startup",
                'response' => $startup,
            ], 200);
        }

        public function getBySession(Request $request)
        {
            Log::debug("session ".$request->token);

            $sesion = $request->token;
            $user = $this->userService->getUserBySession($sesion);
            $user_id = $user->id;
            Log::debug("user_id".$user_id);

            $startups = $this->startupService->getByUserId($user_id);
            return response()->json([
                    'message' => "get startup",
                    'response' => $startups,
                ], 200);
        }

    public function updateStartUpById(Request $request){
        $startup_id = $request->startUpId;
        $name = $request->name;
        $description = $request->description;
        $startups = $this->startupService->updateById($startup_id, $name, $description);

        return response()->json([
            'message' => "get startup",
            'response' => $startups,
        ], 200);

    }

    public function getStartUpById(Request $request)
    {
        $startup_id = $request->startUpId;


        $startup = $this->startupService->getById($startup_id);
        return response()->json([
            'message' => "get by Id",
            'response' => $startup,
        ], 200);
    }

        public function getInversorsAllowedByStartUpId(Request $request){
            $startup_id = $request->startup_id;
            $inversors = $this->startupService->getInversorsAllowedByStartUpId($startup_id);
            return response()->json([
                    'message' => "get inversors",
                    'response' => $inversors,
                ], 200);
        }


        public function createInversor(Request $request){
            $startup_id = $request->startup_id;
            $user_id = $request->IdUser;
            $inversor = $this->startupService->createInversor($startup_id, $user_id);
            return response()->json([
                    'message' => "get inversors",
                    'response' => $inversor,
                ], 200);
        }

        public function createAccessCode(Request $request){

            $startup_id = $request->startup_id;

            $inversor = $this->startupService->generateAccessCode($startup_id);
            return response()->json([
                    'message' => "get inversors",
                    'response' => $inversor,
                ], 200);
        }

        public function getAccessCodeByStartUpId(Request $request){
            $startup_id = $request->startup_id;
            $accessCode = $this->startupService->getAccessCodeByStartUpId($startup_id);

            return response()->json([
                'message' => "get accessCode",
                'response' => $accessCode,
            ], 200);
        }

        public function checkAccessCode(Request $request){
            $user_id =$request->idUser;
            $accessCode = $request->accessCode;
            $response = $this->startupService->checkAccessCode($user_id, $accessCode);

            if($response == null){
                return response()->json([
                    'message' => "check accessCode",
                    'response' => $response,
                ], 403);
            }
            return response()->json([
                'message' => "check accessCode",
                'response' => $response,
            ], 200);

        }
        public function getFounders(Request $request){
        Log::debug("GET FOUNDERS");
            $startup_id = $request->startup_id;
            $response = $this->startupService->getFoundersAllowedByStartUpId($startup_id);
            return response()->json([
                'message' => "get Inversors",
                'response' => $response,
            ], 200);

        }
        public function getInversors(Request $request){
            Log::debug("GET INVERSORS");
            $startup_id = $request->startup_id;
            $response = $this->startupService->getInversorsAllowedByStartUpId($startup_id);

            return response()->json([
                'message' => "get Inversors",
                'response' => $response,
            ], 200);

        }


}


