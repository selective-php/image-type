<?php

namespace Selective\ImageType\Test;

use PHPUnit\Framework\TestCase;
use Selective\ImageType\ImageType;
use Selective\ImageType\ImageTypeDetector;
use SplFileInfo;

/**
 * Test.
 */
class ImageTypeTest extends TestCase
{
    /**
     * Test create object.
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

        $file = new SplFileInfo($file);
        $actual = $imageTypeDetector->getImageTypeFromFile($file);

        $this->assertSame($expected, $actual);
    }

    /**
     * Provider.
     *
     * @return array
     */
    public function providerGetImageTypeFromFile(): array
    {
        return [
            [__DIR__ . '/images/test.gif', 'gif'],
            [__DIR__ . '/images/test.jpg', ImageType::JPEG],
            //[__DIR__ . '/images/test.wbmp', 'wbmp'],
            [__DIR__ . '/images/test-animated.gif', 'gif'],
            [__DIR__ . '/images/test-bmp8.bmp', 'bmp'],
            [__DIR__ . '/images/test-bmp24.bmp', 'bmp'],
            [__DIR__ . '/images/test-png8.png', 'png'],
            [__DIR__ . '/images/test-png24.png', 'png'],
            [__DIR__ . '/images/test-png32.png', 'png'],
            [__DIR__ . '/images/test-tiff8.tif', 'tiff'],
            [__DIR__ . '/images/test-tiff24.tif', 'tiff'],
            [__DIR__ . '/images/test-tiff32.tif', 'tiff'],
            [__DIR__ . '/images/test.psd', 'psd'],
            [__DIR__ . '/images/test.webp', 'webp'],
            [__DIR__ . '/images/test2.webp', 'webp'],
            [__DIR__ . '/images/test.svg', 'svg'],
            [__DIR__ . '/images/test.ico', 'ico'],
            [__DIR__ . '/images/test.cur', 'cur'],
            [__DIR__ . '/images/test.ai', 'ai'],
            [__DIR__ . '/images/test.swf', 'swf'],
        ];
    }
}
