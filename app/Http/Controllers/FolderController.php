<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Folder;
use Illuminate\Support\Facades\Log;
use App\Services\FolderService;


class FolderController extends Controller
{

    protected $folderService;

    public function __construct(FolderService $folderService)
    {
        $this->folderService = $folderService;
    }
    public function create(Request $request)
    {
        $user_id = $request->idUser;
        $name = $request->name;
        $description = $request->description;
        $parent = $request->parent;
        $path = $request->path;
        Log::debug(strval($path));
        

        $folder = $this->folderService->createFolder($user_id, $description, $name, $parent, $path);
        return response()->json([
                'message' => "created folder",
                'response' => $folder,
            ], 200);
    
    }

    public function getById(Request $request)
    {

        $id = $request->$id;

        $folder = $this->folderService->getById($id);
        return response()->json([
                'message' => "getById folder",
                'response' => $folder,
            ], 200);
    
    }

    public function getByParent(Request $request)
    {

        $parent= $request->$parent;

        $folder = $this->folderService->getByParent($parent);
        return response()->json([
                'message' => "getBy parent folder",
                'response' => $folder,
            ], 200);
    
    }

    public function deleteById(Request $request)
    {

        $id = $request->$id;

        $folder = $this->folderService->deleteById($id);
        return response()->json([
                'message' => "delete folder",
                'response' => $folder,
            ], 200);
    
    }

    public function getFoldersByIdUserWithPermisions(Request $request){
        $parent = $request->parent;
        $user_id = $request->idUser;
        return $this->folderService->getFoldersByIdUserWithPermisions($user_id, $parent);
    }
    
}
