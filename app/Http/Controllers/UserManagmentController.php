<?php

namespace App\Http\Controllers;
use Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserManagmentController extends Controller
{
    public function create(Request $request)
    {

        $name = $request->name;
        $password = $request->password;
        $firstName = $request->firstName;
        $secondName = $request->secondName;
        $email = $request->email;
        $type = $request->type;


        $user = User::create([
            "name"=> $name,
            "password"=> $password,
            "email"=> $email,
            "firstName"=> $firstName,
            "secondName"=> $secondName,
            "type"=> $type
        ]);
 
        return response()->json([
                'message' => "created user",
                'response' => $user,
            ], 200);
    
    }

    public function createTest(Request $request)
    {

        $name = "test";
        $password = "test";
        $firstName = "test";
        $secondName = "test";
        $email = "test";
        $type = 0;


        $user = User::create([
            "name"=> $name,
            "password"=> $password,
            "email"=> $email,
            "firstName"=> $firstName,
            "secondName"=> $secondName,
            "type"=> $type

        ]);

        return response()->json([
                'message' => "created user",
                'response' => $user,
            ], 200);
    
    }

    function login(Request $request){
        Log::debug("do login");
        $user = User::where('email', $request->email)->first();

        if (!$user || !password_verify($request->password, $user->password)) {
            Log::debug("do login  fail");

            return response()->json(['message' => 'Invalid email or password'], 401);
        }

        Log::debug("do login succes");

        return response()->json([
                'message' => "valid user",
                'response' => $user,
            ], 200);
    }
}
