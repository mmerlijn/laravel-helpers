<?php

namespace mmerlijn\laravelHelpers\Exceptions;

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
use Throwable;

class DistanceException extends \Exception
{

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct(__CLASS__ . ": $message", $code, $previous);
    }

    // custom string representation of object
    public function __toString()
    {
        return __CLASS__ . ": {$this->message}\n";
    }
}