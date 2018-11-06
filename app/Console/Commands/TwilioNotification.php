<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Twilio\Rest\Client;

class TwilioNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'breakfast:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification to phone number with area code';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $number = $this->ask('What is your number? (format: "+[area code][number]")');

        $sid = config('whatsapp.sid');
        $token = config('whatsapp.token');
        $client = new Client($sid, $token);

        $client->messages->create(
            // the number you'd like to send the message to
            'whatsapp:'.$number,
            array(
                // A Twilio phone number you purchased at twilio.com/console
                'from' => config('whatsapp.number'),
                // the body of the text message you'd like to send
                'body' => 'Testing Twilio WhatsApp API'
            )
        );
    }
}
