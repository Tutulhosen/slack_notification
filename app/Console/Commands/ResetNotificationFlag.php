<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResetNotificationFlag extends Command
{
    protected $signature = 'salat:reset-notification-flag';
    protected $description = 'Reset the notification_sent flag for all salat times';

    public function handle()
    {
        DB::table('salat_times')->update(['notification_sent' => false]);
        $this->info('Notification flags reset');
    }
}

