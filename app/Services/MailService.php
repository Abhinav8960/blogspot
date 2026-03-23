<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class MailService
{
    public function sendToAdmin($mailable)
    {
        Mail::to(config('mail.admin_email'))->send($mailable);
    }
}