<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StartupService;

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
    
    

}

