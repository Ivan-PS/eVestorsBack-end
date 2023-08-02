<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Folder;
use Illuminate\Support\Facades\Log;

class FolderController extends Controller
{
    public function create(Request $request)
    {

        $name = $request->name;
        $description = $request->description;
        $parent = $request->$parent;
        $path = $request->path;

        $folder = Folder::create([
            "name"=> $name,
            "description"=> $description,
            "parent"=> $parent,
            "path"=> $path,
        ]);
 
        return response()->json([
                'message' => "created folder",
                'response' => $folder,
            ], 200);
    
    }

    public function getById(Request $request)
    {

        $id = $request->$id;

        $folder = Folder::where('id', $id)->get();
        return response()->json([
                'message' => "getById folder",
                'response' => $folder,
            ], 200);
    
    }

    public function deleteById(Request $request)
    {

        $id = $request->$id;

        $folder = Folder::where('id', $id)->delete();
        return response()->json([
                'message' => "delete folder",
                'response' => $folder,
            ], 200);
    
    }
    
}
