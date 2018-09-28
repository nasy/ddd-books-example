<?php

namespace MyCompany\Email\Infrastructure\Fake;

use MyCompany\Email\DomainModel\EmailSenderService;
use MyCompany\Email\DomainModel\EmailObject;

class FakeSendEmailService implements EmailSenderService
{
    public function send(EmailObject $email)
    {
        return null;
    }
}
