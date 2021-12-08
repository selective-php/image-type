<?php

namespace Selective\ImageType\Test;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeType;

/**
 * Test.
 */
class ImageTypeTest extends TestCase
{
    /**
     * Test.
     */
    public function testCreateInstance(): void
    {
        $imageType = new ImageType(ImageFormat::JPEG, MimeType::IMAGE_JPEG);

        $this->assertSame(ImageFormat::JPEG, $imageType->getFormat());
        $this->assertSame(MimeType::IMAGE_JPEG, $imageType->getMimeType());
    }

    /**
     * Test.
     */
    public function testCreateInstanceWithError(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new ImageType('', '');
    }

    /**
     * Test.
     */
    public function testCreateInstanceWithError2(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new ImageType(ImageFormat::JPEG, '');
    }
}
