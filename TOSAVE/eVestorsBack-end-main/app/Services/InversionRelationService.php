<?php

namespace App\Services;

use App\Daos\InversionRelationDao;
use Illuminate\Support\Facades\Log;

class InversionRelation
{
    protected $fileDao;

    public function __construct(InversionRelationDao $inversionRelationDao)
    {
        $this->inversionRelationDao = $inversionRelationDao;
    }


    public function getById($id){
        return $this->inversionRelartionDao->getById($id);
    }
}
