# selective/image-type

Image type detection library for PHP.

[![Latest Version on Packagist](https://img.shields.io/github/release/selective-php/image-type.svg)](https://packagist.org/packages/selective/image-type)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE.md)
[![Build Status](https://travis-ci.org/selective-php/image-type.svg?branch=master)](https://travis-ci.org/selective-php/image-type)
[![Coverage Status](https://scrutinizer-ci.com/g/selective-php/image-type/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/selective-php/image-type/code-structure)
[![Total Downloads](https://img.shields.io/packagist/dt/selective/image-type.svg)](https://packagist.org/packages/selective/image-type/stats)


## Features

* Detect image type from file content (not the extension)
* Supported formats: JPG, GIF, PNG, WEBP, BMP, PSD, TIFF, SVG, ICO, CUR, SWF and AI files
* No dependencies
* Very fast

## Requirements

* PHP 7.2+

## Installation

```
composer require selective/image-type
```

## Usage

### Detecting the image type of an file

```php
use Selective\ImageType\ImageTypeDetector;

$file = new SplFileInfo('example.jpg');

$imageTypeDetector = new ImageTypeDetector();
echo $imageTypeDetector->getImageTypeFromFile($file)->toString(); // jpeg
```

### Detecting the image type of an in-memory object

```php
use Selective\ImageType\ImageTypeDetector;

$image = new SplTempFileObject();
$image->fwrite('my file content');

$imageTypeDetector = new ImageTypeDetector();
echo $imageTypeDetector->getImageTypeFromFile($file)->toString();
```

## Similar libraries

* https://github.com/willwashburn/fasterimage

## License

* MIT
