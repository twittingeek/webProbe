<?php

namespace twittingeek\webProbe\Probes\Dtos;

class HTMLPageDto
{

    /**
     * @var string
     */
    private $head;

    /** @var string */
    private $body;

    public function __construct(string $body, string $head)
    {
        $this->head = $head;
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getHead(): string
    {
        return $this->head;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

}