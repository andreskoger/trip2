<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;

class MailTest extends Command
{

    protected $signature = 'mail:test';

  
    public function handle()
    {
  
            Mail::raw('Test email', function ($message) {

                $message->to('sink@sink.sendgrid.net')
                    ->subject('Mail test');

                $swiftMessage = $message->getSwiftMessage();
                $headers = $swiftMessage->getHeaders();

                $header = [
                    'category' => [
                        'test'
                    ],
                    'unique_args' => [
                        'test_id' => '1'
                    ],
                ];

                $headers->addTextHeader('X-SMTPAPI', format_smtp_header($header));

            });

    }
}
