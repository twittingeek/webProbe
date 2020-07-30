<?php

namespace webProbe\Probes\Exceptions;

use Exception;

class ScrapeElementNotFound extends Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}