[![Build Status](https://travis-ci.org/WouterSioen/country-list.svg?branch=master)](https://travis-ci.org/WouterSioen/country-list)

# Abandoned

You can do the same things as with this package using the symfony/intl component https://symfony.com/doc/master/components/intl.html#country-names

# Country list

A wrapper around <https://github.com/umpirsky/country-list> to easily fetch a list of countries in a certain language or get a specific country by country code and language.

# Installing

composer.json

```json
{
    "require": {
        "woutersioen/country-list": "dev-master"
    }
}
```

index file for your project

```php
// update this to the path to the "vendor/" directory, relative to this file
require_once '../vendor/autoload.php';
```

# Usage

### With dependency injection container:

First add an instance of the class ```Sioen\Countries``` to your dependency injection container.

```php
// fetch an array of countries in a language
$languages = $this->getContainer()->get('countries')->getForLanguage('en');

// fetch one country in a language
$language = $this->getContainer()->get('countries')->getSpecificForLanguage('be', 'en');
// returns 'Belgium'
```

Most modern PHP Frameworks have a dependency injection container. This is the prefered way, since there will only be one instance of the countries object, and data will be cached in this object.

### PHP 5.4 (+)

```php
use Sioen\Countries;

// fetch an array of countries in a language
$languages = (new Countries)->getForLanguage('en');

// fetch one country in a language
$language = (new Countries)->getSpecificForLanguage('be', 'en');
// returns 'Belgium'
```

### PHP 5.3

```php
use Sioen\ContryList;

$countries = new Countries();

// fetch an array of countries in a language
$languages = $countries->getForLanguage('en');

// fetch one country in a language
$language = $countries->getSpecificForLanguage('be', 'en');
// returns 'Belgium'
```
