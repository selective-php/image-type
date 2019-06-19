<?php

namespace Selective\ImageType\Test;

use PHPUnit\Framework\TestCase;
use Selective\ImageType\ImageType;
use Selective\ImageType\ImageTypeDetector;
use Selective\ImageType\ImageTypeDetectorException;
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

        $file = new SplFileObject($file);
        $actual = $imageTypeDetector->getImageTypeFromFile($file);

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
            //[__DIR__ . '/images/test.wbmp', 'wbmp'],
            [__DIR__ . '/images/test-animated.gif', ImageType::GIF],
            [__DIR__ . '/images/test-bmp8.bmp', ImageType::BMP],
            [__DIR__ . '/images/test-bmp24.bmp', ImageType::BMP],
            [__DIR__ . '/images/test-png8.png', ImageType::PNG],
            [__DIR__ . '/images/test-png24.png', ImageType::PNG],
            [__DIR__ . '/images/test-png32.png', ImageType::PNG],
            [__DIR__ . '/images/test-tiff8.tif', ImageType::TIFF],
            [__DIR__ . '/images/test-tiff24.tif', ImageType::TIFF],
            [__DIR__ . '/images/test-tiff32.tif', ImageType::TIFF],
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
