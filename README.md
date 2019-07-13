# selective/image-type

Image type detection library for PHP.

[![Latest Version on Packagist](https://img.shields.io/github/release/selective-php/image-type.svg?style=flat-square)](https://packagist.org/packages/selective/image-type)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/selective-php/image-type/master.svg?style=flat-square)](https://travis-ci.org/selective-php/image-type)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/selective-php/image-type.svg?style=flat-square)](https://scrutinizer-ci.com/g/selective-php/image-type/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/quality/g/selective-php/image-type.svg?style=flat-square)](https://scrutinizer-ci.com/g/selective-php/image-type/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/selective/image-type.svg?style=flat-square)](https://packagist.org/packages/selective/image-type/stats)


## Features

* Detection of the image type based on its content (header)
* No dependencies
* Very fast

### Supported formats

#### Raster

* **JPG** / **JPEG** (Joint Photographic Experts Group)
* **GIF** (Graphics Interchange Format)
* **PNG** (Portable Network Graphics)
* **WEBP** (WebP)
* **BMP** (Windows Bitmap)
* **PSD** (Photoshop Document)
* **TIF** / **TIFF** (Tagged Image File Format)
* **ICO** (Icon)
* **CUR** (Cursor)
* **ANI** (Animated Cursor)
* **HEIF** / **HEIC** (High Efficiency Image File Format) / Apple iPhone photos
* **JPEG 2000**
* **JPM** (JPEG 2000 compound image)
* **PDN** (PaintDotNet)
* **JNG** (JPEG Network Graphics)
* **DICOM** (Digital Imaging and Communications in Medicine)
* **XCF** (eXperimental Computing Facility (GIMP))
* **MNG** (Multiple-image Network Graphics)
* **PSB** (Photoshop Large Document)

#### Vector

* **SVG** (Scalable Vector Graphics)
* **AI** (Adobe Illustrator)
* **WMF** (Windows Metafile Format)
* **EMF** (Enhanced Metafile)
* **EMF+** (Enhanced Metafile)

#### Compound

* **SWF** (Small Web Format, Flash)

#### RAW

* **CR3** (Canon)
* **CR2** (Cannon)
* **PEF** (Pentax)
* **RW2** (Panasonic)
* **PEF** (Pentax)
* **3FR** (Hasselblad)
* **IIQ** (Phase One)
* **ORF** (Olympus)
* **DNG** (Digital Negative - Adobe)

#### HDR

* **JPEG-HDR**
* **Radiance HDR**
* **CIN** (Cineon Image File Format, Kodak)
* **PFM** (Portable Float Map)
* **DPX** (Digital Picture Exchange)
* **PBM** (Portable Bit Map HDR)
* **OpenEXR**

## Requirements

* PHP 7.2+

## Installation

```
composer require selective/image-type
```

## Usage

### Detect the image type of file

```php
use Selective\ImageType\ImageTypeDetector;
use Selective\ImageType\Provider\DefaultProvider;
use Selective\ImageType\Provider\HdrProvider;
use Selective\ImageType\Provider\RawProvider;
use SplFileObject;

$file = new SplFileObject('example.jpg');

$detector = new ImageTypeDetector();

// Add image detectors
$detector->addProvider(new HdrProvider());
$detector->addProvider(new RawProvider());
$detector->addProvider(new DefaultProvider());

echo $detector->getImageTypeFromFile($file)->toString(); // jpeg
```

### Detect the image type of in-memory object

```php
$image = new SplTempFileObject();

$image->fwrite('my file content');

$detector = new ImageTypeDetector();

// Add image detectors
$detector->addProvider(new RawProvider());
$detector->addProvider(new DefaultProvider());

echo $detector->getImageTypeFromFile($file)->toString();
```

## Similar libraries

* https://github.com/exiftool/exiftool
* https://github.com/willwashburn/fasterimage

## License

* MIT
