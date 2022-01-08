<?php

namespace mmerlijn\laravelHelpers\Exceptions;

class SMSPhoneException extends \Exception
{
    /**
     * @param mixed $message
     */
    public function setMessage(?string $message = null): void
    {
        if ($message) {
            $this->message = $message;
        } else {
            $this->message = "Not a valid dutch SMS phone number";
        }
    }
}