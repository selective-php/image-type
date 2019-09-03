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

* **ANI** (Animated Cursor)
* **BMP** (Windows Bitmap)
* **CUR** (Cursor)
* **DICOM** (Digital Imaging and Communications in Medicine)
* **GIF** (Graphics Interchange Format)
* **HEIF** / **HEIC** (High Efficiency Image File Format) / Apple iPhone photos
* **ICO** (Icon)
* **JNG** (JPEG Network Graphics)
* **JPEG 2000**
* **JPG** / **JPEG** (Joint Photographic Experts Group)
* **JPM** (JPEG 2000 compound image)
* **MNG** (Multiple-image Network Graphics)
* **PDN** (PaintDotNet)
* **PGM** (Portable Graymap)
* **PNG** (Portable Network Graphics)
* **PPM** (Portable Pixelmap)
* **PSB** (Photoshop Large Document)
* **PSD** (Photoshop Document)
* **TIF** / **TIFF** (Tagged Image File Format)
* **WEBP** (WebP)
* **XCF** (eXperimental Computing Facility (GIMP))

#### Vector

* **AI** (Adobe Illustrator)
* **EMF** (Enhanced Metafile)
* **EMF+** (Enhanced Metafile)
* **SVG** (Scalable Vector Graphics)
* **WMF** (Windows Metafile Format)

#### Compound

* **SWF** (Small Web Format, Flash)

#### RAW

* **3FR** (Hasselblad)
* **CR2** (Cannon)
* **CR3** (Canon)
* **DNG** (Digital Negative - Adobe)
* **IIQ** (Phase One)
* **ORF** (Olympus)
* **PEF** (Pentax)
* **RW2** (Panasonic)

#### HDR

* **JPEG-HDR**
* **CIN** (Cineon Image File Format, Kodak)
* **DPX** (Digital Picture Exchange)
* **OpenEXR**
* **PBM** (Portable Bit Map HDR)
* **PFM** (Portable Float Map)
* **Radiance HDR**

## Requirements

* PHP 7.1+

## Installation

```
composer require selective/image-type
```

## Usage

### Detect the image type of file

```php
use Selective\ImageType\ImageTypeDetector;
use Selective\ImageType\Provider\RasterProvider;
use Selective\ImageType\Provider\HdrProvider;
use Selective\ImageType\Provider\RawProvider;
use Selective\ImageType\Provider\VectorProvider;
use SplFileObject;

$file = new SplFileObject('example.jpg');

$detector = new ImageTypeDetector();

// Add image detectors
$detector->addProvider(new HdrProvider());
$detector->addProvider(new RawProvider());
$detector->addProvider(new VectorProvider());
$detector->addProvider(new RasterProvider());

$imageType = $detector->getImageTypeFromFile($file);

// Get the image format
echo $imageType->getFormat(); // jpeg

// Get the mime type
echo $imageType->getMimeType(); // image/jpeg
```

### Detect the image type of in-memory object

```php
$image = new SplTempFileObject();

$image->fwrite('my file content');

$detector = new ImageTypeDetector();

// Add image detectors
$detector->addProvider(new RasterProvider());

echo $detector->getImageTypeFromFile($file)->getFormat();
```

## Similar libraries

* https://github.com/exiftool/exiftool
* https://github.com/willwashburn/fasterimage

## License

* MIT
