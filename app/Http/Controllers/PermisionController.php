<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permision;

class PermisionController extends Controller
{
    public function create(Request $request)
    {

        $user_id = $request->user_id;
        $folder_id = $request->folder_id;

        $permisionFolder = Permision::create([
            "user_id"=> $user_id,
            "folder_id"=> $folder_id,
        ]);
 
        return response()->json([
                'message' => "created permisionFolder",
                'response' => $permisionFolder,
            ], 200);
    }

    public function getIfPermisionUserFolder(Request $request)
    {

        $user_id = $request->user_id;
        $folder_id = $request->folder_id;

        $folder = Permision::where('user_id', $user_id)->where('folder_id', $folder_id)->get();

 
        return response()->json([
                'message' => "get permisionFolder",
                'response' => count($folder) > 0,
            ], 200);
    }

    public function deleteById(Request $request)
    {

        $user_id = $request->user_id;
        $folder_id = $request->folder_id;

        $folder = Permision::where('id', $id)->delete();

 
        return response()->json([
                'message' => "delete permisionFolder",
                'response' => $folder,
            ], 200);
    }


}
