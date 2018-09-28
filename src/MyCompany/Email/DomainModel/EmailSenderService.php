<?php

namespace MyCompany\Email\DomainModel;

interface EmailSenderService
{
    public function send(EmailObject $email);
}
