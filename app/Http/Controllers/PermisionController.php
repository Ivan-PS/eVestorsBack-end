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
        $item_id = $request->item_id;
        $type = $request->type;

        $permisionFolder = Permision::create([
            "user_id"=> $user_id,
            "item_id"=> $item_id,
            "type" => $type
        ]);

        return response()->json([
                'message' => "created permisionFolder",
                'response' => $permisionFolder,
            ], 200);
    }

    public function getIfPermisionUserFolder(Request $request)
    {

        $user_id = $request->user_id;
        $item_id = $request->item_id;

        $folder = Permision::where('user_id', $user_id)->where('item_id', $item_id)->where('type', 1)->get();


        return response()->json([
                'message' => "get permisionFolder",
                'response' => count($folder) > 0,
            ], 200);
    }

    public function getIfPermisionUserFile(Request $request)
    {

        $user_id = $request->user_id;
        $item_id = $request->item_id;

        $folder = Permision::where('user_id', $user_id)->where('item_id', $item_id)->where('type', 2)->get();


        return response()->json([
                'message' => "get permisionFolder",
                'response' => count($folder) > 0,
            ], 200);
    }
    public function deleteById(Request $request)
    {

        $id = $request->id;


        $folder = Permision::where('id', $id)->delete();


        return response()->json([
                'message' => "delete permisionFolder",
                'response' => $folder,
            ], 200);
    }




}
