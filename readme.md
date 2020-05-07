# MyKad Validator

Validate MyKad/MyKid number to make sure:

- Valid length 
- Contains numbers only
- Valid date
- Valid state/country code

This package will remove other unnecessary characters from the input, including dashes.

## Introduction

One of the most annoying things when dealing with user records is when they entered wrong MyKad/MyKid number. This package helps reduce the burden to deal with invalid input by users.

## Installation

You can install the package via composer:

```composer require ppzwp/mykad-validator```

## Usage

```php
use PPZWP\MyKadValidator\Validator;

$validator = new Validator;

// This will throw \PPZWP\MyKadValidator\Exceptions\InvalidDateException
if ($validator->validate('982404-06-5883')) {
    // the rest of your code
}

// This will throw \PPZWP\MyKadValidator\Exceptions\InvalidLengthException
if ($validator->validate('982404-06-83')) {
    // the rest of your code
}

// This will throw \PPZWP\MyKadValidator\Exceptions\InvalidCodeException
if ($validator->validate('980404-00-5335')) {
    // the rest of your code
}

// This will throw \PPZWP\MyKadValidator\Exceptions\InvalidCharacterException
if ($validator->validate('9804AA-00-5335')) {
    // the rest of your code
}
```

## Testing

```composer test```

## License

The MIT License (MIT).