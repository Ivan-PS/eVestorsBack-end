<?php

namespace App\Service;

use App\Daos\FolderDao;
use Illuminate\Support\Facades\Log;

class FolderService
{
    protected $folderDao;

    public function __construct(FolderDao $folderDao)
    {
        $this->folderDao = $folderDao;
    }

}
