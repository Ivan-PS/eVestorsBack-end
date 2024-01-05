<?php

namespace App\Http\Controllers;

use App\Daos\PermisionDao;
use App\Http\Controllers\Controller;
use App\Services\StartupService;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Models\Folder;
use Illuminate\Support\Facades\Log;
use App\Services\FolderService;
use function Webmozart\Assert\Tests\StaticAnalysis\length;


class FolderController extends Controller
{

    protected $folderService;
    protected  $inversionPermisionService;
    protected $startUpService;
    protected $userService;
    public function __construct(FolderService $folderService, PermisionDao $inversionPermisionService, StartupService $startupService, UserService $userService)
    {
        $this->folderService = $folderService;
        $this->inversionPermisionService = $inversionPermisionService;
        $this->startUpService = $startupService;
        $this->userService = $userService;
    }
    public function create(Request $request)
    {
        Log::debug("CREATE FOLDER");
        $user = $this->userService->getUserBySession($request->token);
        $user_id = $user->id;
        $name = $request->name;
        $description = $request->description;
        $parent = $request->parent;
        $path = $request->path;
        $startup_id = $request->startup_id;



        $folder = $this->folderService->createFolder($user_id, $name, $description, $parent, $path, $startup_id);
        if ($startup_id != 0){

            $byStartups = $this->userService->getUsersInStartUpFounders($startup_id);
            $byInversions = $this->userService->getUsersInStartUpInversors($startup_id);
            Log::info(str(count($byStartups)));
            Log::info(implode(" startup :, ", $byStartups));
            Log::info(implode(', ', $byInversions));
            foreach ($byStartups as $byStartup){
                Log::info($byStartup->id != $user_id);
                if($byStartup->id != $user_id){
                    $this->inversionPermisionService->create($byStartup->id, $folder->id, 1);
                }
            }
            foreach ($byInversions as $byInversion){
                if($byInversion->id != $user_id){
                    $this->inversionPermisionService->create($byInversion->id, $folder->id, 1);
                }
            }
        }

        return response()->json([
                'message' => "created folder",
                'response' => $folder,
            ], 200);

    }

    public function getById(Request $request)
    {

        $id = $request->id;

        $folder = $this->folderService->getById($id);
        return response()->json([
                'message' => "getById folder",
                'response' => $folder,
            ], 200);

    }

    public function getByParent(Request $request)
    {

        $parent= $request->parent;
        $startup_id = $request->startup_id;

        $folder = $this->folderService->getByParent($parent, $startup_id);
        return response()->json([
                'message' => "getBy parent folder",
                'response' => $folder,
            ], 200);

    }

    public function deleteById(Request $request)
    {

        $id = $request->id;

        $folder = $this->folderService->deleteById($id);
        return response()->json([
                'message' => "delete folder",
                'response' => $folder,
            ], 200);

    }

    public function getFoldersByIdUserWithPermisions(Request $request){
        $user = $this->userService->getUserBySession($request->token);
        $parent = $request->parent;
        $user_id = $user->id;
        $startup_id = $request->startup_id;
        $folders = $this->folderService->getFoldersByIdUserWithPermisions($user_id, $parent, $startup_id);
        return response()->json([
            'message' => "get folder with permision",
            'response' => $folders,
        ], 200);
    }

}
