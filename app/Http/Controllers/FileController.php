<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Log;
use App\Services\FileService;


class FileController extends Controller
{

    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }
    public function create(Request $request)
    {

        $name = $request->name;
        $description = $request->description;
        $parent = $request->$parent;
        $path = $request->path;

        $file = $this->fileService->createFile($user_id, $name, $parent, $path);
        return response()->json([
                'message' => "created file",
                'response' => $file,
            ], 200);
    
    }

    public function getById(Request $request)
    {

        $id = $request->$id;

        $file = $this->fileService->getById($id);
        return response()->json([
                'message' => "getById file",
                'response' => $file,
            ], 200);
    
    }

    public function getByParent(Request $request)
    {

        $parent= $request->$parent;

        $file = $this->fileService->getByParent($parent);
        return response()->json([
                'message' => "getBy parent file",
                'response' => $file,
            ], 200);
    
    }

    public function deleteById(Request $request)
    {

        $id = $request->$id;

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
    
}
