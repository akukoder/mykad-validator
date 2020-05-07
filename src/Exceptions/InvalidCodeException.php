<?php

namespace PPZWP\MyKadValidator\Exceptions;

class InvalidCodeException extends \InvalidArgumentException
{
    protected $code = 414;
    protected $message = 'Invalid state/country code';
}