<?php

namespace App\Http\Controllers;
use Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Log;

class UserManagmentController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request $request)
    {

        $name = $request->name;
        $password = $request->password;
        $firstName = $request->firstName;
        $secondName = $request->secondName;
        $email = $request->email;
        $type = $request->type;

        $user = $this->userService->registerUser($name, $password, $firstName, $secondName, $email, $type);

        if($isOK){
            return response()->json([
                'message' => "created user",
                'response' => $user,
            ], 200);
        }
        return response()->json([
            'message' => "Error Crete User",
        ], 401);



    }


    function login(Request $request){
        $email = $request->email;
        $password = $request->password;
        if(!$this->userService->login($email, $password)){
            return response()->json(['message' => 'Invalid email or password'], 401);
        }
        return response()->json([
            'message' => "valid user",
            'response' => $user,
        ], 200);

    }

    public function getById(Request $request)
    {

        $id = $request->$id;

        $user = User::where('id', $id)->get();
        return response()->json([
                'message' => "getById USER",
                'response' => $user,
            ], 200);

    }


}
