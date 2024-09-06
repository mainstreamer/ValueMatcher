# ValueMatcher

A simple PHP library for searching json values inside json or sub-arrays inside arrays.

## Installation

You can install this package via [Composer](https://getcomposer.org/):

```bash
composer require epiclesys/value-matcher
````

Mach json values inside other json

Say we need to check if this json value 
```
{ "key" : ["value"] };
```
is contained somewhere here
```
{
  "level9": {
    "finalLevel": "reached",
    "stillGoing": true,
    "data" : { "key" : ["one", 2, "value"] }
  }
}
```

Usage

```php
 <?php
 
 require __DIR__ . '/vendor/autoload.php';
 
 use Epiclesys\ValueMatcher\JsonMatcher; 
 
 $needle = '{ "key" : ["value"] }';
 $haystack = '
 {
    "level9": {
    "finalLevel": "reached",
    "stillGoing": true,
    "data" : { "key" : ["one", 2, "value"] }
    }
 }';
 
 JsonMatcher::contains($needle, $haystack); // true
````

Similarly works for matching array values inside another array 

```bash
 ArrayMatcher::contains($needle, $haystack); // true
```

This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).