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
    protected $description = 'Command description';

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
        $sid = 'AC19e2dcc68b0f758969d0cf807721af4a';
        $token = '459308477dc32601b597efadd30a94b5';
        $client = new Client($sid, $token);


        $client->messages->create(
            // the number you'd like to send the message to
            'whatsapp:+5492804661836',
            array(
                // A Twilio phone number you purchased at twilio.com/console
                'from' => 'whatsapp:+14155238886',
                // the body of the text message you'd like to send
                'body' => 'Hey Jenny! Good luck on the bar exam!'
            )
        );
    }
}
