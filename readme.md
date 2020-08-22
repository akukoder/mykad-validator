# MyKad Validator

[![Build Status](https://travis-ci.org/akukoder/mykad-validator.svg?branch=master)](https://travis-ci.org/akukoder/mykad-validator)
![GitHub tag (latest by date)](https://img.shields.io/github/v/tag/akukoder/mykad-validator)
![Packagist PHP Version Support (custom server)](https://img.shields.io/packagist/php-v/akukoder/mykad-validator)
![Packagist License](https://img.shields.io/packagist/l/akukoder/mykad-validator)


## About MyKad

<blockquote>
    The Government Multi-Purpose Smart Card Project (MPSC) or MyKad is part of the Multimedia Super Corridor (MSC Malaysia) initiative.
</blockquote>

## Introduction

One of the most annoying thing when dealing with user records is when they entered wrong MyKad/MyKid number. 
This package helps reduce the burden to deal with invalid input by users.

This package will validate MyKad/MyKid number to make sure:

- Contains numbers only
- Valid length 
- Valid date of birth
- Valid state/country code

***Note:***

Any other unnecessary characters from the input will be removed, including dashes.

## Installation

You can install the package via composer:

```
composer require akukoder/mykad-validator
```

## Usage

```php
use AkuKoder\MyKadValidator\Validator;

$validator = new Validator;

// This will return false
if ($validator->validate('982404-06-5883')) {
    
}

// This will return false
if ($validator->validate('982404-06-83')) {
    
}

// This will return false
if ($validator->validate('980404-00-5335')) {
    
}

// This will return false
if ($validator->validate('9804AA-00-5335')) {
    
}

// This will return true
if ($validator->validate('980404-06-5335')) {
    
}
```

### Get exception on errors

```php
use AkuKoder\MyKadValidator\Validator;

$validator = new Validator;

// This will throw \akukoder\MyKadValidator\Exceptions\InvalidDateException
if ($validator->validate('982404-06-5883', true)) {
    
}

// This will throw \akukoder\MyKadValidator\Exceptions\InvalidLengthException
if ($validator->validate('982404-06-83', true)) {
    
}

// This will throw \akukoder\MyKadValidator\Exceptions\InvalidCodeException
if ($validator->validate('980404-00-5335', true)) {
    
}

// This will throw \akukoder\MyKadValidator\Exceptions\InvalidCharacterException
if ($validator->validate('9804AA-00-5335', true)) {
    
}
```

## Testing

```
composer test
```

## Reference

1. [https://www.jpn.gov.my/en/informasimykad/mykad/](https://www.jpn.gov.my/en/informasimykad/mykad/)

## License

The MIT License (MIT).