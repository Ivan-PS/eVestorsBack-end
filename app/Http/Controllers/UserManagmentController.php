<?php

namespace App\Http\Controllers;
use App\Daos\PermisionDao;
use App\Services\FileService;
use App\Services\FolderService;
use App\Services\StartupService;
use Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Log;

class UserManagmentController extends Controller
{

    protected $userService;
    protected  $folderService;
    protected $fileService;
    protected  $startUpService;
        public function __construct(UserService $userService, FileService $fileService, FolderService $folderService, StartupService $startupService)
    {
        $this->userService = $userService;
        $this->fileService = $fileService;
        $this->folderService = $folderService;
        $this->startUpService = $startupService;
    }

    public function register(Request $request)
{
    Log::debug("TO CREATE USER: ");
    $name = $request->name;
    $password = $request->password;
    $firstName = $request->firstName;
    $secondName = $request->secondName;
    $email = $request->email;
    $type = $request->type;

    $user = $this->userService->registerUser($name, $password, $firstName, $secondName, $email, $type);

    Log::debug("USER CREATED: " . strval($user));


    if($user != null){
        return response()->json([
            'message' => "created user",
            'response' => $user,
        ], 200);
    }
    return response()->json([
        'message' => "Error Crete User",
    ], 401);





}

    public function createFounder(Request $request)
    {
        Log::debug("TO CREATE USER: ");
        $name = $request->name;
        $password = $request->password;
        $firstName = $request->firstName;
        $secondName = $request->secondName;
        $email = $request->email;
        $type = $request->type;
        $startup_id = $request->startup_id;

        $user = $this->userService->registerUser($name, $password, $firstName, $secondName, $email, $type);
        $this->startUpService->createStartUpPermision($startup_id, $user->id);
        $this->folderService->createPermisionsToAllFoldersFromStartup($user->id, $startup_id);


        $this->fileService->createPermisionsToAllFilesFromStartup($user->id, $startup_id);

        Log::debug("USER CREATED: " . strval($user));


        if($user != null){
            return response()->json([
                'message' => "created user",
                'response' => $user,
            ], 200);
        }
        return response()->json([
            'message' => "Error Crete User",
        ], 401);





    }


    public function login(Request $request){
        $email = $request->email;
        $password = $request->password;
        if(!$this->userService->loginUser($email, $password)){
            return response()->json(['message' => 'Invalid email or password'], 401);
        }
        $user = $this->userService->getByEmail($email);
        return response()->json([
            'message' => "valid user",
            'response' => $user,
        ], 200);

    }

    public function getById(Request $request)
    {

        $id = $request->id;

        $user = User::where('id', $id)->get();
        return response()->json([
                'message' => "getById USER",
                'response' => $user,
            ], 200);

    }


    public function getRelatedUsers(Request $request){
        $users = [];
        $user_id = $request->idUser;

        $startups = $this->startUpService->getByUserId($user_id);

        foreach($startups as $startup){
            $byStartups = $this->userService->getUsersInStartUpFounders($startup->id);
            $byInversions = $this->userService->getUsersInStartUpInversors($startup->id);
            foreach ($byStartups as $byStartup){
                if($byStartup->id != $user_id){
                    array_push($users, $byStartup);
                }
            }
            foreach ($byInversions as $byInversion){
                if($byInversion->id != $user_id){
                    array_push($users, $byInversion);
                }
            }
        }




        return response()->json([
            'message' => "getRelatedUsers",
            'response' => $users,
        ], 200);
    }

    public function updateById(Request $request){
        $user_id = $request->user_id;
        $email = $request->email;
        $name = $request->name;
        $firstName = $request->firstName;
        $secondName = $request->secondName;
        $user = $this->userService->updateById($user_id, $email, $name, $firstName, $secondName);
        return response()->json([
            'message' => "update user",
            'response' => $user,
        ], 200);
    }


}
