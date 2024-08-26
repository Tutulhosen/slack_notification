<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\SalatTime;

class SendSalatNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:salat-times';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a Slack notification 10 minutes before Namaz time';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $now = now(); // Current time
        $tenMinutesFromNow = $now->copy()->addMinutes(10);

        $salatTimes = SalatTime::whereBetween('namaz_time', [$now->format('H:i:s'), $tenMinutesFromNow->format('H:i:s')])
                            ->get();

        if ($salatTimes->isEmpty()) {
            return;
        }

        $slackWebhookUrl = 'https://hooks.slack.com/services/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';
        $this->sendSlackNotification($now, $slackWebhookUrl);

        foreach ($salatTimes as $salatTime) {
            $this->sendSlackNotification($salatTime, $slackWebhookUrl);
        }
    }

    

    /**
     * Send Slack notification.
     *
     * @param  SalatTime  $salatTime
     * @param  string  $slackWebhookUrl
     * @return void
     */
    protected function sendSlackNotification($salatTime, $slackWebhookUrl)
    {
        $client = new Client();
        $message = "Reminder: The Namaz time for fajar is at now.";

        try {
            $response = $client->post($slackWebhookUrl, [
                'json' => [
                    'text' => $message,
                ],
            ]);

            \Log::info('Slack notification sent: ' . $response->getBody());
        } catch (\Exception $e) {
            \Log::error('Error sending Slack notification: ' . $e->getMessage());
        }
    }

}
