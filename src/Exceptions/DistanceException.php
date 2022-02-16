<?php

namespace mmerlijn\laravelHelpers\Exceptions;

use Throwable;

class DistanceException extends \Exception
{

    /**
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct(__CLASS__ . ": $message", $code, $previous);
    }


    /**
     * custom string representation of object
     *
     * @return string
     */
    public function __toString()
    {
        return __CLASS__ . ": {$this->message}\n";
    }
}