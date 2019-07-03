<?php

namespace Selective\ImageType\Test;

use PHPUnit\Framework\TestCase;
use Selective\ImageType\ImageType;
use Selective\ImageType\ImageTypeDetector;
use Selective\ImageType\ImageTypeDetectorException;
use Selective\ImageType\Provider\DefaultProvider;
use Selective\ImageType\Provider\RawProvider;
use SplFileObject;
use SplTempFileObject;

/**
 * Test.
 */
class ImageTypeDetectorTest extends TestCase
{
    /**
     * Test.
     *
     * @dataProvider providerGetImageTypeFromFile
     *
     * @param string $file The file
     * @param string $expected The expected value
     *
     * @return void
     */
    public function testGetImageTypeFromFile(string $file, string $expected): void
    {
        $this->assertFileExists($file);

        $imageTypeDetector = new ImageTypeDetector();

        $imageTypeDetector->addProvider(new RawProvider());
        $imageTypeDetector->addProvider(new DefaultProvider());

        $file = new SplFileObject($file);
        $actual = $imageTypeDetector->getImageTypeFromFile($file);

        $this->assertSame($expected, $actual->toString());
        $this->assertTrue($actual->equals(new ImageType($expected)));
    }

    /**
     * Provider.
     *
     * @return array
     */
    public function providerGetImageTypeFromFile(): array
    {
        return [
            [__DIR__ . '/images/test.gif', ImageType::GIF],
            [__DIR__ . '/images/test.jpg', ImageType::JPEG],
            [__DIR__ . '/images/test-animated.gif', ImageType::GIF],
            [__DIR__ . '/images/test-bmp8.bmp', ImageType::BMP],
            [__DIR__ . '/images/test-bmp24.bmp', ImageType::BMP],
            [__DIR__ . '/images/test-png8.png', ImageType::PNG],
            [__DIR__ . '/images/test-png24.png', ImageType::PNG],
            [__DIR__ . '/images/test-png32.png', ImageType::PNG],
            [__DIR__ . '/images/test-tiff8.tif', ImageType::TIFF],
            [__DIR__ . '/images/test-tiff24.tif', ImageType::TIFF],
            [__DIR__ . '/images/test-tiff32.tif', ImageType::TIFF],
            [__DIR__ . '/images/test.iiq', ImageType::TIFF],
            [__DIR__ . '/images/test-phase-one.iiq', ImageType::TIFF],
            [__DIR__ . '/images/test.psd', ImageType::PSD],
            [__DIR__ . '/images/test.webp', ImageType::WEBP],
            [__DIR__ . '/images/test2.webp', ImageType::WEBP],
            [__DIR__ . '/images/test.svg', ImageType::SVG],
            [__DIR__ . '/images/test.ico', ImageType::ICO],
            [__DIR__ . '/images/test.cur', ImageType::CUR],
            [__DIR__ . '/images/test.ai', ImageType::AI],
            [__DIR__ . '/images/test.swf', ImageType::SWF],
            [__DIR__ . '/images/test-alpha.heic', ImageType::HEIC],
            [__DIR__ . '/images/test-animation.heic', ImageType::HEIC],
            [__DIR__ . '/images/test-raw.cr3', ImageType::CR3],
            [__DIR__ . '/images/test-raw2.cr3', ImageType::CR3],
            [__DIR__ . '/images/test-mif1.heic', ImageType::HEIC],
            [__DIR__ . '/images/test-panasonic-lumix-dmc-lx3-01.rw2', ImageType::RW2],
            [__DIR__ . '/images/test-raw-pentax-k10D-srgb.pef', ImageType::PEF],
            [__DIR__ . '/images/test.cr2', ImageType::CR2],
            [__DIR__ . '/images/test-1a-1.3fr', ImageType::FR3],
            [__DIR__ . '/images/test-1a-2.3fr', ImageType::FR3],
            [__DIR__ . '/images/test-1b.3fr', ImageType::FR3],
            [__DIR__ . '/images/test-iiro.orf', ImageType::ORF],
            [__DIR__ . '/images/test-iirs.orf', ImageType::ORF],
            [__DIR__ . '/images/test-mmor.orf', ImageType::ORF],
            [__DIR__ . '/images/test-dng1.dng', ImageType::DNG],
            [__DIR__ . '/images/test-dng2.dng', ImageType::DNG],
            [__DIR__ . '/images/test-cin1.cin', ImageType::CIN],
            [__DIR__ . '/images/test-cin2.cin', ImageType::CIN],
            [__DIR__ . '/images/test-pfm.pfm', ImageType::PFM],
        ];
    }

    /**
     * Test.
     *
     * @return void
     */
    public function testGetImageTypeWithUnknownFormat(): void
    {
        $this->expectException(ImageTypeDetectorException::class);
        $this->expectExceptionMessage('Image type could not be detected');

        $imageTypeDetector = new ImageTypeDetector();

        $image = new SplTempFileObject();
        $image->fwrite('temp');

        $imageTypeDetector->getImageTypeFromFile($image);
    }
}
