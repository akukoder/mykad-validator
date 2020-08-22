<?php

namespace AkuKoder\MyKadValidator\Exceptions;

class InvalidCharacterException extends \InvalidArgumentException
{
    protected $code = 412;
    protected $message = 'Invalid character included';
}