<?php

namespace App\Daos;

use App\Models\InversionRelation;
use Illuminate\Support\Facades\Log;

class InversionRelationDao
{
    public function create($owner_id, $inversor_id, $percent)
    {

        $inversion = InversionRelation::create([
            "owner_id"=> $owner_id,
            "inversor_id"=> $inversor_id,
            "percent"=> $parent
        ]);

        return $inversion;

    }

    public function deleteById($id){

        $inversion = InversionRelation::where('id', $id)->delete();

        return $inversion;

    }

    public function getByOwnerId($owner_id){
        $inversion = InversionRelation::where('owner_id', $owner_id)->get();

        return $inversion;
    }

    public function getByInversorId($inversor_id){
        $inversion = InversionRelation::where('inversor_id', $inversor_id)->get();

        return $inversion;
    }

    public function updateById($id, $owner_id, $inversor_id, $percent)
    {
        $inversion = InversionRelation::where('id', $id)->update([
            "owner_id"=> $owner_id,
            "inversor_id"=> $inversor_id,
            "percent"=> $parent
        ]);
        return $inversion;
    }

}
