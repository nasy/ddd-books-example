<?php

namespace AppBundle\Response;

class ApiResponse
{
    /** @var bool */
    private $status;
    private $data;
    /** @var string */
    private $message;

    public function __construct(bool $status = true, $data = null, string $message = '')
    {
        $this->status = $status;
        $this->data = $data;
        $this->message = $message;
    }

    public function toArray(): array
    {
        $formattedResponse = [];
        $formattedResponse['status'] = $this->status ? 'success' : 'error';
        if (null !== $this->data) {
            $formattedResponse['data'] = $this->data;
        }
        if (!empty($this->message)) {
            $formattedResponse['message'] = $this->message;
        }
        return $formattedResponse;
    }
}
