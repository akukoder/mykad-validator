# MyKad Validator

[![Build Status](https://travis-ci.org/ppzwp/mykad-validator.svg?branch=master)](https://travis-ci.org/ppzwp/mykad-validator)
![GitHub tag (latest by date)](https://img.shields.io/github/v/tag/ppzwp/mykad-validator)
![Packagist PHP Version Support (custom server)](https://img.shields.io/packagist/php-v/ppzwp/mykad-validator)
![Packagist License](https://img.shields.io/packagist/l/ppzwp/mykad-validator)
[![Coverage Status](https://coveralls.io/repos/github/ppzwp/mykad-validator/badge.svg?branch=master)](https://coveralls.io/github/ppzwp/mykad-validator?branch=master)

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
composer require ppzwp/mykad-validator
```

## Usage

```php
use PPZWP\MyKadValidator\Validator;

$validator = new Validator;

// This will throw false
if ($validator->validate('982404-06-5883')) {
    
}

// This will throw false
if ($validator->validate('982404-06-83')) {
    
}

// This will throw false
if ($validator->validate('980404-00-5335')) {
    
}

// This will throw false
if ($validator->validate('9804AA-00-5335')) {
    
}

// This will throw true
if ($validator->validate('980404-06-5335')) {
    
}
```

### Get exception on errors

```php
use PPZWP\MyKadValidator\Validator;

$validator = new Validator;
// This will throw \PPZWP\MyKadValidator\Exceptions\InvalidDateException
if ($validator->validate('982404-06-5883', true)) {
    
}

// This will throw \PPZWP\MyKadValidator\Exceptions\InvalidLengthException
if ($validator->validate('982404-06-83', true)) {
    
}

// This will throw \PPZWP\MyKadValidator\Exceptions\InvalidCodeException
if ($validator->validate('980404-00-5335', true)) {
    
}

// This will throw \PPZWP\MyKadValidator\Exceptions\InvalidCharacterException
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