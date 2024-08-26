<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class SendSalatNotification extends Command
{
    protected $signature = 'salat:notify';
    protected $description = 'Send a notification to Slack 10 minutes before salat times';

    public function handle()
    {
        $current_time = Carbon::now();

        // Get salat times from the database
        $salat_times = DB::table('salat_times')->where('notification_sent', false)->get();
        foreach ($salat_times as $salat) {
            $namaz_time = Carbon::createFromFormat('Y-m-d H:i:s', $current_time->format('Y-m-d') . ' ' . $salat->namaz_time);
            $notification_time = $namaz_time->copy()->subMinutes(10);
           

                if ($current_time->between($notification_time, $namaz_time)) {
                    $this->sendSlackNotification($namaz_time);

                    // Mark the notification as sent
                    DB::table('salat_times')->where('id', $salat->id)->update(['notification_sent' => true]);
                }
            }

        return 0;
    }

    protected function sendSlackNotification($namaz_time)
    {
        $webhook_url = env('SLACK_WEBHOOK_URL');

        $message = "It's almost time for Salat! The namaz is at . It's remaining only 10 minute" ;

        Http::post($webhook_url, [
            'text' => $message
        ]);
    }
}
