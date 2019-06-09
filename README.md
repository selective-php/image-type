# selective/image-type

Image type detection library for PHP.

[![Latest Version on Packagist](https://img.shields.io/github/release/selective-php/image-type.svg)](https://packagist.org/packages/selective/image)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE.md)
[![Build Status](https://travis-ci.org/selective-php/image-type.svg?branch=master)](https://travis-ci.org/selective-php/image-type)
[![Coverage Status](https://scrutinizer-ci.com/g/selective-php/image-type/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/selective-php/image-type/code-structure)
[![Total Downloads](https://img.shields.io/packagist/dt/selective/image.svg)](https://packagist.org/packages/selective/image/stats)


## Features

* Detect image type from file content (not the extension)
* Supported formats: JPEG, GIF, PNG, BMP, soon more...

## Requirements

* PHP 7.2+

## Installation

```
composer require selective/image-type
```

## Usage

### Detect image type from file

```php
use Selective\ImageType;

$file = new SplFileInfo('example.jpg');

$imageTypeDetector = new ImageTypeDetector();
echo $imageTypeDetector->getImageTypeFromFile($file); // jpeg
```

## Similar libraries

* https://github.com/willwashburn/fasterimage

## License

* MIT