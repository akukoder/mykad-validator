<?php

namespace PPZWP\MyKadValidator\Exceptions;

class InvalidDateException extends \InvalidArgumentException
{
    protected $code = 413;
    protected $message = 'Invalid date';
}