<?php

namespace App\Services;

use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Configuration;
use GuzzleHttp\Client;

class BrevoMailService
{
    public static function sendMail($to, $subject, $htmlContent)
    {
        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', env('BREVO_API_KEY'));
        $apiInstance = new TransactionalEmailsApi(new Client(), $config);

        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail([
            'subject' => $subject,
            'sender' => ['name' => env('MAIL_FROM_NAME'), 'email' => env('MAIL_FROM_ADDRESS')],
            'to' => [['email' => $to]],
            'htmlContent' => $htmlContent,
        ]);

        $apiInstance->sendTransacEmail($sendSmtpEmail);
    }
}
