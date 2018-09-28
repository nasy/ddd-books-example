<?php

namespace MyCompany\Email\Infrastructure\SparkPost;

use MyCompany\Email\DomainModel\EmailSenderService;
use MyCompany\Email\DomainModel\EmailObject;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class SparkPostSendEmailService implements EmailSenderService
{
    /** @var array */
    private $sparkPost;
    /** @var EngineInterface */
    private $templateEngine;
    /** @var bool */
    private $emailsEnabled;

    public function __construct(
        \Swift_Mailer $sparkPost,
        EngineInterface $templateEngine,
        bool $emailsEnabled
    ) {
        $this->sparkPost = $sparkPost;
        $this->templateEngine = $templateEngine;
        $this->emailsEnabled =  $emailsEnabled;
    }

    public function send(EmailObject $email)
    {
        $html = $this->templateEngine->render(
            $email->template(),
            $email->data()
        );
        $message = (new \Swift_Message($email->subject()))
            ->setFrom(['pleasereply@kalendify.com' => 'El equipo Kalendify'])
            ->setTo($email->recipients())
            ->setBcc(['ignasi.tuduri@gmail.com'])
            ->setBody(
                $html,
                'text/html'
            );
        if($this->emailsEnabled){
            $this->sparkPost->send($message);
        }
    }
}
