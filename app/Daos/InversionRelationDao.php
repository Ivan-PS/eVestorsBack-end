<?php

namespace App\Daos;

use App\Models\InversionRelation;
use Illuminate\Support\Facades\Log;

class InversionRelationDao
{
    public function create($owner_id, $inversor_id, $percent)
    {

        $inversion = InversorRelation::create([
            "owner_id"=> $owner_id,
            "inversor_id"=> $inversor_id,
            "percent"=> $parent
        ]);

        return $inversion;

    }

    public function deleteById($id){

        $inversion = InversorRelation::where('id', $id)->delete();

        return $inversion;

    }

    public function getByOwnerId($owner_id){
        $inversion = InversorRelation::where('owner_id', $owner_id)->get();

        return $inversion;
    }

    public function getByInversorId($inversor_id){
        $inversion = InversorRelation::where('inversor_id', $inversor_id)->get();

        return $inversion;
    }

    public function updateById($id, $owner_id, $inversor_id, $percent)
    {
        $inversion = InversorRelation::where('id', $id)->update([
            "owner_id"=> $owner_id,
            "inversor_id"=> $inversor_id,
            "percent"=> $parent
        ]);
        return $inversion;
    }

}
