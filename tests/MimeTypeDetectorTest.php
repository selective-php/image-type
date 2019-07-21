<?php

namespace Selective\ImageType\Test;

use PHPUnit\Framework\TestCase;
use Selective\ImageType\Exception\MimeTypeNotFoundException;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeTypeDetector;

/**
 * Test.
 */
class MimeTypeDetectorTest extends TestCase
{
    /**
     * Test.
     *
     * @dataProvider providerGetMimeType
     *
     * @param string $type The type
     * @param string $expected The expected value
     *
     * @return void
     */
    public function testGetMimeType(string $type, string $expected): void
    {
        $mimeTypeDetector = new MimeTypeDetector();

        $imageType = new ImageType($type);
        $actual = $mimeTypeDetector->getMimeType($imageType);

        $this->assertNotEmpty($actual);
    }

    /**
     * Provider.
     *
     * @return array
     */
    public function providerGetMimeType(): array
    {
        // @todo

        return [
            [ImageType::AI, ''],
            [ImageType::ANI, ''],
            [ImageType::BMP, ''],
            [ImageType::CIN, ''],
            [ImageType::CR2, ''],
            [ImageType::CR3, ''],
            [ImageType::CUR, ''],
            [ImageType::DICOM, ''],
            [ImageType::DNG, ''],
            [ImageType::DPX, ''],
            [ImageType::EMF, ''],
            [ImageType::EMF_PLUS, ''],
            [ImageType::EXR, ''],
            [ImageType::FR3, ''],
            [ImageType::GIF, ''],
            [ImageType::HDR, ''],
            [ImageType::HEIC, ''],
            [ImageType::HEIC_SEQUENCE, ''],
            [ImageType::ICO, ''],
            [ImageType::JP2, ''],
            [ImageType::JPEG, ''],
            [ImageType::JPEG_HDR, ''],
            [ImageType::JPM, ''],
            [ImageType::MNG, ''],
            [ImageType::ORF, ''],
            [ImageType::PBM, ''],
            [ImageType::PDN, ''],
            [ImageType::PEF, ''],
            [ImageType::PFM, ''],
            [ImageType::PGM, ''],
            [ImageType::PNG, ''],
            [ImageType::PPM, ''],
            [ImageType::PSB, ''],
            [ImageType::PSD, ''],
            [ImageType::RW2, ''],
            [ImageType::SVG, ''],
            [ImageType::SWF, ''],
            [ImageType::TIFF, ''],
            [ImageType::WEBP, ''],
            [ImageType::WMF, ''],
            [ImageType::XCF, ''],
        ];
    }

    /**
     * Test.
     *
     * @return void
     */
    public function testGetImageTypeWithUnknownFormat(): void
    {
        $this->expectException(MimeTypeNotFoundException::class);
        $this->expectExceptionMessage('Mime type not found for image type: ZZZ');

        $mimeTypeDetector = new MimeTypeDetector();

        $imageType = new ImageType('ZZZ');

        $mimeTypeDetector->getMimeType($imageType);
    }
}
