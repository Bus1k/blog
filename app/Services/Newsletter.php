<?php

namespace App\Services;

use \MailchimpMarketing\ApiClient;

class Newsletter
{
    private ApiClient $mailchimp;
    private string $subscribersList;

    public function __construct()
    {
        $this->mailchimp = new ApiClient();
        $this->setConfig();
    }

    private function setConfig(): void
    {
        $this->subscribersList = config('services.mailchimp.lists.subscribers');

        $this->mailchimp->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => config('services.mailchimp.prefix')
        ]);
    }

    public function subscribe(string $email, string $list = null)
    {
        $list ??= $this->subscribersList;

        return $this->mailchimp->lists->addListMember($list, [
            'email_address' => $email,
            'status'        => 'subscribed'
        ]);
    }
}
