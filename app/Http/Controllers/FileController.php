<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Log;

class FileController extends Controller
{
    public function create(Request $request)
    {

        $name = $request->name;
        $description = $request->description;
        $parent = $request->$parent;
        $path = $request->path;

        $file = File::create([
            "name"=> $name,
            "description"=> $description,
            "parent"=> $parent,
            "path"=> $path,
        ]);
 
        return response()->json([
                'message' => "created file",
                'response' => $file,
            ], 200);
    
    }

    public function getById(Request $request)
    {

        $id = $request->$id;

        $file = File::where('id', $id)->get();
        return response()->json([
                'message' => "getById file",
                'response' => $file,
            ], 200);
    
    }

    public function getByParent(Request $request)
    {

        $parent= $request->$parent;

        $file = File::where('parent', $parent)->get();
        return response()->json([
                'message' => "getBy parent file",
                'response' => $file,
            ], 200);
    
    }

    public function deleteById(Request $request)
    {

        $id = $request->$id;

        $file = File::where('id', $id)->delete();
        return response()->json([
                'message' => "delete file",
                'response' => $file,
            ], 200);
    
    }
    
}
