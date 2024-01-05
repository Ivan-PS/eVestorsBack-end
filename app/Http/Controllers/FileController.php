<?php

namespace App\Http\Controllers;

use App\Daos\PermisionDao;
use App\Http\Controllers\Controller;
use App\Services\StartupService;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Log;
use App\Services\FileService;
use App\Services\FolderService;
use App\Services\InversionRelation;

use Illuminate\Support\Facades\Storage;



class FileController extends Controller
{

    protected $fileService;
    protected  $folderService;
    protected  $inversionPermisionService;
    protected $startUpService;
    protected $create;
    public function __construct(FileService $fileService, FolderService $folderService, PermisionDao $inversionPermisionService, StartupService $startupService, UserService $userService)
    {
        $this->fileService = $fileService;
        $this->folderService = $folderService;
        $this->inversionPermisionService = $inversionPermisionService;
        $this->startUpService = $startupService;
        $this->userService = $userService;
    }

    public function create(Request $request)
    {
        Log::debug((str("VALUE FILE REQUEST")));
        Log::debug((str($request)));
        $sesion = $request->input('token');
        $user = $this->userService->getUserBySession($sesion);
        $user_id = $user->id;
        $startup_id = $request->input("startup_id");
        $folder_name = $request->input("folder_name");
        $folder_id = $request->input("folder_id");
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $path = "";
        Log::debug("Startup_id: ".str($startup_id));
        if ($startup_id == 0){
            $path = "User/".$user_id."/".$folder_name;

        }
        else{
            $path = "StartUp/".$startup_id."/".$folder_name;
        }
        Log::debug("path: ".str($path));

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        // $uploadPath = $uploadDir . basename($file["name"]);

        $this->folderService->createFolderOnServer($user_id, $folder_name, $startup_id);

        $filePath = public_path($path);
        $file->move($filePath, $fileName);
        $fileCreated = $this->fileService->createFile($user_id, $folder_id, $startup_id, $path."/".$fileName, $fileName);
        if ($startup_id != 0){
            $byStartups = $this->userService->getUsersInStartUpFounders($startup_id);
            $byInversions = $this->userService->getUsersInStartUpInversors($startup_id);
            foreach ($byStartups as $byStartup){
                if($byStartup->id != $user_id){
                    $this->inversionPermisionService->create($byStartup->id, $startup_id, 2);
                }
            }
            foreach ($byInversions as $byInversion){
                if($byInversion->id != $user_id){
                    $this->inversionPermisionService->create($byInversion->id, $startup_id, 2);
                }
            }
        }
        /*if($startup_id != 0){
            $this->fileService->createPermisionsToAllUsersOnStartUp($startup_id, $fileCreated->id);

        }*/

        return response()->json([
                'message' => "created file",
                'response' => $fileCreated,
            ], 200);

    }

    public function getById(Request $request)
    {

        $id = $request->id;

        $file = $this->fileService->getById($id);
        return response()->json([
                'message' => "getById file",
                'response' => $file,
            ], 200);

    }

    public function getByParent(Request $request)
    {

        $parent= $request->parent;
        $startup_id = $request->startup_id;



        $file = $this->fileService->getByParent($parent, $startup_id);
        return response()->json([
                'message' => "getBy parent file",
                'response' => $file,
            ], 200);

    }

    public function deleteById(Request $request)
    {

        $id = $request->id;

        $file = $this->fileService->deleteById($id);
        return response()->json([
                'message' => "delete file",
                'response' => $file,
            ], 200);

    }

    /*public function getFoldersByIdUserWithPermisions(Request $request){
        $parent = $request->parent;
        $user_id = $request->idUser;
        return $this->folderService->getFoldersByIdUserWithPermisions($user_id, $parent);
    }*/

    public function getFilesByIdUserWithPermisions(Request $request){
        $folder_id = $request->parent;
        $sesion = $request->input('token');
        $user = $this->userService->getUserBySession($sesion);
        $user_id = $user->id;
        $startup_id = $request->startup_id;

        $files = $this->fileService->getFilesByIdUserWithPermisions($user_id, $folder_id, $startup_id);
        Log::debug($files);
        return response()->json([
            'message' => "get folder with permision",
            'response' => $files,
        ], 200);
    }

    public function downloadFileById(Request $request){
        $file = $this->fileService->getById($request->file_id);
        $fileSaved = public_path($file->path);
        return response()->download($fileSaved);
    }

    public function getFileView($file_id)
    {
        $file = $this->fileService->getById($file_id);
        $path = public_path($file->path);

        if (file_exists($path)) {
            return response()->file($path);
        } else {
            return abort(404, 'File not found');
        }
    }





}
