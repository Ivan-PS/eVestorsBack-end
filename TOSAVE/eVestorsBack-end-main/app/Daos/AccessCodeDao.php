<?php

namespace App\Daos;

use App\Models\AccessCode;
use Illuminate\Support\Facades\Log;

class AccessCodeDao
{
    public function create($startup_id, $accessCode)
    {

        $accessCode = AccessCode::create([
            'startup_id'=>$startup_id,
            'accessCode'=>$accessCode
        ]);

        return $accessCode;
    }

    public function getByAccessCode($accessCode)
    {
        Log::debug("CHECK ACCESS CODE: ".strval($accessCode));
        $accessCode = AccessCode::where('accessCode', $accessCode)->first();
        return $accessCode;
    }

    public function getByStartUpId($startup_id)
    {

        $accessCode = AccessCode::where('startup_id', $startup_id)->first();
        return $accessCode;
    }

    public function getByStartUpAndAccessCode($startup_id, $accessCode){
        $accessCode = AccessCode::where('accessCode', $accessCode)->where('startup_id', $startup_id)->first();
        return $accessCode;
    }

    public function deletAccessCodeById(){
        $accessCode = AccessCode::where('id', $id)->delete();
        return $accessCode;
    }

}
