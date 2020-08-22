<?php

namespace AkuKoder\MyKadValidator\Exceptions;

class InvalidLengthException extends \InvalidArgumentException
{
    protected $code = 411;
    protected $message = 'Invalid input length';
}