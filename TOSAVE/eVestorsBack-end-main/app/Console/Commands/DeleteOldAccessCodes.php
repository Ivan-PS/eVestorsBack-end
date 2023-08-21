<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AccessCode;

class DeleteOldAccessCodes extends Command
{
    protected $signature = 'delete:old-accesscodes';
    protected $description = 'Delete AccessCodes older than 2 minutes';

    public function handle()
    {
        $twoMinutesAgo = Carbon::now()->subMinutes(2);

        AccessCode::where('created_at', '<', $tenMinutesAgo)->delete();

        $this->info('Old Access code deleted successfully.');
    }
}
