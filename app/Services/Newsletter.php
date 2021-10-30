<?php

namespace App\Services;

use \MailchimpMarketing\ApiClient;

class Newsletter
{
    private $mailchimp;

    public function __construct()
    {
        $this->mailchimp = new ApiClient();
        $this->setConfig();
    }

    private function setConfig(): void
    {
        $this->mailchimp->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => config('services.mailchimp.prefix')
        ]);
    }

    public function subscribe(string $email)
    {
        return $this->mailchimp->lists->addListMember('fbf3911273', [
            'email_address' => $email,
            'status'        => 'subscribed'
        ]);
    }
}
