<?php

namespace PPZWP\MyKadValidator\Test;

use Orchestra\Testbench\TestCase;
use PPZWP\MyKadValidator\Exceptions\InvalidCharacterException;
use PPZWP\MyKadValidator\Exceptions\InvalidCodeException;
use PPZWP\MyKadValidator\Exceptions\InvalidDateException;
use PPZWP\MyKadValidator\Exceptions\InvalidLengthException;
use PPZWP\MyKadValidator\Validator;

class ValidatorTest extends TestCase
{
    protected Validator $validator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = new Validator;
    }

    public function testLengthException()
    {
        $this->expectException(InvalidLengthException::class);

        $this->validator->validate('8008081020');
    }

    public function testCharacterException()
    {
        $this->expectException(InvalidCharacterException::class);

        $this->validator->validate('8O0808102000');
    }

    public function testDateException()
    {
        $this->expectException(InvalidDateException::class);

        $this->validator->validate('001238-10-2000');
    }

    public function testStateCodeException()
    {
        $this->expectException(InvalidCodeException::class);

        $this->validator->validate('801208-00-2000');
    }
}