<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InversorRelation;

class InversionRelationController extends Controller
{
    public function create(Request $request)
    {

        $owner_id = $request->owner_id;
        $inversor_id = $request->inversor_id;
        $percent = $request->percent;



        $inversion = InversorRelation::create([
            "owner_id"=> $owner_id,
            "inversor_id"=> $inversor_id,
            "percent"=> $parent
        ]);
 
        return response()->json([
                'message' => "created inversion",
                'response' => $inversion,
            ], 200);
    
    }

    public function deleteById(Request $request){

        $id = $request->id;
        $inversion = InversorRelation::where('id', $id)->delete();
 
        return response()->json([
                'message' => "delete inversion",
                'response' => $inversion,
            ], 200);
    
    }

    public function getByOwnerId(Request $request){
        $owner_id = $request->owner_id;
        $inversion = InversorRelation::where('owner_id', $owner_id)->get();
 
        return response()->json([
                'message' => "get inversion by owner",
                'response' => $inversion,
            ], 200);
    }

    public function getByInversorId(){
        $inversor_id = $request->inversor_id;
        $inversion = InversorRelation::where('inversor_id', $inversor_id)->get();
 
        return response()->json([
                'message' => "get inversion by inversor",
                'response' => $inversion,
            ], 200);
    }

    public function updateById(Request $request)
    {

        $owner_id = $request->owner_id;
        $inversor_id = $request->inversor_id;
        $percent = $request->percent;
        $id = $request->id;


        $inversion = InversorRelation::where('id', $id)->update([
            "owner_id"=> $owner_id,
            "inversor_id"=> $inversor_id,
            "percent"=> $parent
        ]);
 
        return response()->json([
                'message' => "update inversion",
                'response' => $inversion,
            ], 200);
    
    }


}
