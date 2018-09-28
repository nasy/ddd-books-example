<?php

namespace MyCompany\Email\DomainModel;

class EmailObject
{
    /** @var array */
    protected $recipients;
    /** @var string */
    protected $subject;

    public function __construct(
        $subject,
        $recipients
    )
    {
        $this->subject = $subject;
        $this->recipients = $recipients;
    }

    public function subject() : string
    {
        return $this->subject;
    }

    public function recipients() : array
    {
        return $this->recipients;
    }
}
