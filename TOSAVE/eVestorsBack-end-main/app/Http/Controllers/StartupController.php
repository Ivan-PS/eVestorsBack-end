<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StartupService;
use Illuminate\Support\Facades\Log;

class StartupController extends Controller
{
    protected $startupService;

    public function __construct(StartupService $startupService)
    {
        $this->startupService = $startupService;
    }
    public function create(Request $request)
    {
        $user_id = $request->idUser;

        $name = $request->name;
        $description = $request->description;


        $startup = $this->startupService->createStartup($user_id, $name, $description);
        return response()->json([
                'message' => "created startup",
                'response' => $startup,
            ], 200);
        }

        public function getByIdUser(Request $request)
        {
            $user_id = $request->idUser;


            $startups = $this->startupService->getByUserId($user_id);
            return response()->json([
                    'message' => "get startup",
                    'response' => $startups,
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


}


