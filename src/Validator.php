<?php

namespace AkuKoder\MyKadValidator;

use AkuKoder\MyKadValidator\Exceptions\InvalidCharacterException;
use AkuKoder\MyKadValidator\Exceptions\InvalidCodeException;
use AkuKoder\MyKadValidator\Exceptions\InvalidDateException;
use AkuKoder\MyKadValidator\Exceptions\InvalidLengthException;

class Validator
{
    // Length of the input, exactly 12
    const inputLength = 12;

    /**
     * Validate the string and return boolean result if success or throw exception on errors
     *
     * @param string    $mykad      MyKad or MyKid number
     * @param bool      $returnException
     * @return bool
     */
    public function validate(string $mykad, $returnException = false) : bool
    {
        $input = $this->cleaner($mykad);

        if ($this->verifyLength($input) === false) {
            if ($returnException === false) {
                return false;
            }

            throw new InvalidLengthException;
        }

        if ($this->verifyCharacters($input) === false) {
            if ($returnException === false) {
                return false;
            }

            throw new InvalidCharacterException;
        }

        if ($this->verifyDate($input) === false) {
            if ($returnException === false) {
                return false;
            }

            throw new InvalidDateException;
        }

        if ($this->verifyStateCode($input) === false) {
            if ($returnException === false) {
                return false;
            }

            throw new InvalidCodeException;
        }

        return true;
    }

    /**
     * Check the string and return boolean result if success or false errors
     *
     * @param string $mykad
     * @return bool
     */
    public function check(string $mykad) : bool
    {
        if ($this->validate($mykad) !== true) {
            return false;
        }

        // Other exceptions, just return false
        return true;
    }

    /**
     * Verify the input length
     *
     * @param string $input
     * @return bool
     */
    protected function verifyLength(string $input) : bool
    {
        return strlen($input) === self::inputLength;
    }

    /**
     * Check if the input contains other than numbers
     *
     * Reference: https://stackoverflow.com/questions/236406/is-there-a-difference-between-is-int-and-ctype-digit
     *
     * @param  $input string    MyKad / MyKid number
     * @return bool
     */
    protected function verifyCharacters(string $input) : bool
    {
        return is_numeric($input);
    }

    /**
     * Check state/country code
     *
     * Sources:
     *  1. https://www.jpn.gov.my/en/kod-negeri/
     *  2. https://www.jpn.gov.my/en/kod-negara/
     *
     * @param $input     string     MyKad / MyKid number
     * @return bool
     */
    protected function verifyStateCode(string $input) : bool
    {
        $code = substr($input, 6, 2);

        $jpnCodes = json_decode(file_get_contents(__DIR__.'/codes.json'), true)['codes'];

        return in_array($code, $jpnCodes);
    }

    /**
     * Extract date from input
     *
     * @param string $input
     * @return bool
     */
    protected function verifyDate(string $input) : bool
    {
        $year = substr($input, 0, 2);
        $month = substr($input, 2, 2);
        $day = substr($input, 4, 2);

        return checkdate($month, $day, $year);
    }

    /**
     * Clean-up input string
     *
     * @param string $input
     * @return string
     */
    protected function cleaner(string $input) : string
    {
        $input = trim($input);
        $input = str_replace('-', '', $input);

        return preg_replace('/[^A-Za-z0-9\-]/', '', $input);
    }
}
