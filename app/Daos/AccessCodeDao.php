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

        $accessCode = AccessCode::where('accessCode', $accessCode)->get();
        return $accessCode;
    }

}
