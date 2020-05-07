<?php

namespace PPZWP\MyKadValidator;

use DateTime;
use PPZWP\MyKadValidator\Exceptions\InvalidCharacterException;
use PPZWP\MyKadValidator\Exceptions\InvalidCodeException;
use PPZWP\MyKadValidator\Exceptions\InvalidDateException;
use PPZWP\MyKadValidator\Exceptions\InvalidLengthException;

class Validator
{
    // Length of the input
    const inputLength = 12;

    /**
     * Validate the string and return boolean result if success or throw exceptoin on errors
     *
     * @param $input    string      MyKad or MyKid number
     * @return bool
     */
    public function validate(string $input) : bool
    {
        $input = $this->cleaner($input);

        // Check length, exactly 12 character
        if (strlen($input) != self::inputLength) {
            throw new InvalidLengthException;
        }

        if ($this->verifyCharacters($input) === false) {
            throw new InvalidCharacterException;
        }

        if ($this->verifyDate($input) === false) {
            throw new InvalidDateException;
        }

        if ($this->verifyStateCode($input) === false) {
            throw new InvalidCodeException;
        }

        return true;
    }

    /**
     * Check if the input contains other than numbers
     *
     * Reference: https://stackoverflow.com/questions/236406/is-there-a-difference-between-is-int-and-ctype-digit
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
     * @param $input     string     MyKad / MyKid number
     * @return bool
     */
    protected function verifyStateCode(string $input) : bool
    {
        // Check state code
        $code = substr($input, 6, 2);

        /*
         * Sources:
         *  1. https://www.jpn.gov.my/en/kod-negeri/
         *  2. https://www.jpn.gov.my/en/kod-negara/
         */
        $jpnCodes = [
            // Malaysia
            '01', '21', '22', '23', '24', '02', '25', '26', '27', '03', '28', '29', '04', '30', '05', '31', '59', '06',
            '32', '33', '07', '34', '35', '08', '36', '37', '38', '39', '09', '40', '10', '41', '42', '43', '44', '11',
            '45', '46', '12', '47', '48', '49', '13', '50', '51', '52', '53', '14', '54', '55', '56', '57', '15', '58',
            '16', '82',

            // Other countries
            '99', '93', '92', '91', '90', '89', '88', '87', '86', '85', '84', '83', '79', '78', '77', '76', '75', '74',
            '72', '71', '67', '66', '65', '64', '63', '62', '61', '60',
        ];

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
        // Trim input, remove any symbols
        $input = trim($input);
        $input = str_replace('-', '', $input);
        return preg_replace('/[^A-Za-z0-9\-]/', '', $input);
    }
}
