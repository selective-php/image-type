<?php

namespace Selective\ImageType\Test;

use PHPUnit\Framework\TestCase;
use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\ImageTypeDetector;
use Selective\ImageType\ImageTypeDetectorException;
use Selective\ImageType\MimeType;
use Selective\ImageType\Provider\CompoundProvider;
use Selective\ImageType\Provider\HdrProvider;
use Selective\ImageType\Provider\RasterProvider;
use Selective\ImageType\Provider\RawProvider;
use Selective\ImageType\Provider\VectorProvider;
use SplFileObject;
use SplTempFileObject;

/**
 * Test.
 */
class ImageTypeDetectorTest extends TestCase
{
    /**
     * Create instance.
     *
     * @return ImageTypeDetector The detector
     */
    private function createDetector(): ImageTypeDetector
    {
        $detector = new ImageTypeDetector();

        $detector->addProvider(new CompoundProvider());
        $detector->addProvider(new VectorProvider());
        $detector->addProvider(new HdrProvider());
        $detector->addProvider(new RawProvider());
        $detector->addProvider(new RasterProvider());

        return $detector;
    }

    /**
     * Test.
     *
     * @dataProvider providerGetImageTypeFromFile
     *
     * @param string $file The file
     * @param string $format The expected format
     * @param string $mime The expected mime type
     *
     * @return void
     */
    public function testGetImageTypeFromFile(string $file, string $format, string $mime): void
    {
        $this->assertFileExists($file);

        $detector = $this->createDetector();
        $file = new SplFileObject($file);
        $actual = $detector->getImageTypeFromFile($file);

        $this->assertSame($format, $actual->getFormat());
        $this->assertSame($mime, $actual->getMimeType());
        $this->assertTrue($actual->equals(new ImageType($format, $mime)));
    }

    /**
     * Provider.
     *
     * @return array
     */
    public static function providerGetImageTypeFromFile(): array
    {
        return [
            [__DIR__ . '/images/test.ai', ImageFormat::AI, MimeType::APPLICATION_POSTSCRIPT],
            [__DIR__ . '/images/test.ani', ImageFormat::ANI, MimeType::APPLICATION_X_NAVI_ANIMATION],
            [__DIR__ . '/images/test.cr2', ImageFormat::CR2, MimeType::IMAGE_CR2],
            [__DIR__ . '/images/test.cur', ImageFormat::CUR, MimeType::IMAGE_X_ICON],
            [__DIR__ . '/images/test.dcm', ImageFormat::DICOM, MimeType::APPLICATION_DICOM],
            [__DIR__ . '/images/test.emf', ImageFormat::EMF, MimeType::IMAGE_X_EMF],
            [__DIR__ . '/images/test.exr', ImageFormat::EXR, MimeType::IMAGE_X_EXR],
            [__DIR__ . '/images/test.gif', ImageFormat::GIF, MimeType::IMAGE_GIF],
            [__DIR__ . '/images/test.ico', ImageFormat::ICO, MimeType::IMAGE_X_ICON],
            [__DIR__ . '/images/test.iiq', ImageFormat::TIFF, MimeType::IMAGE_TIFF],
            [__DIR__ . '/images/test.jp2', ImageFormat::JP2, MimeType::IMAGE_JP2],
            [__DIR__ . '/images/test.jpg', ImageFormat::JPEG, MimeType::IMAGE_JPEG],
            [__DIR__ . '/images/test.jpm', ImageFormat::JPM, MimeType::IMAGE_JPM],
            [__DIR__ . '/images/test.mng', ImageFormat::MNG, MimeType::VIDEO_X_MNG],
            [__DIR__ . '/images/test.pbm', ImageFormat::PBM, MimeType::IMAGE_X_PORTABLE_BITMAP],
            [__DIR__ . '/images/test.pdn', ImageFormat::PDN, MimeType::IMAGE_X_PAINTNET],
            [__DIR__ . '/images/test.pgm', ImageFormat::PGM, MimeType::IMAGE_X_PORTABLE_GRAYMAP],
            [__DIR__ . '/images/test.ppm', ImageFormat::PPM, MimeType::IMAGE_X_PORTABLE_PIXMAP],
            [__DIR__ . '/images/test.psb', ImageFormat::PSB, MimeType::IMAGE_X_PSB],
            [__DIR__ . '/images/test.psd', ImageFormat::PSD, MimeType::IMAGE_VND_ADOBE_PHOTOSHOP],
            [__DIR__ . '/images/test.svg', ImageFormat::SVG, MimeType::IMAGE_SVG_XML],
            [__DIR__ . '/images/test.swf', ImageFormat::SWF, MimeType::APPLICATION_X_SHOCKWAVE_FLASH],
            [__DIR__ . '/images/test.webp', ImageFormat::WEBP, MimeType::IMAGE_WEBP],
            [__DIR__ . '/images/test.wmf', ImageFormat::WMF, MimeType::IMAGE_X_WMF],
            [__DIR__ . '/images/test.xcf', ImageFormat::XCF, MimeType::IMAGE_X_XCF],
            [__DIR__ . '/images/test-1.dpx', ImageFormat::DPX, MimeType::IMAGE_X_DPX],
            [__DIR__ . '/images/test-1a-1.3fr', ImageFormat::FR3, MimeType::IMAGE_X_3_FR],
            [__DIR__ . '/images/test-1a-2.3fr', ImageFormat::FR3, MimeType::IMAGE_X_3_FR],
            [__DIR__ . '/images/test-1b.3fr', ImageFormat::FR3, MimeType::IMAGE_X_3_FR],
            [__DIR__ . '/images/test-2.emf', ImageFormat::EMF, MimeType::IMAGE_X_EMF],
            [__DIR__ . '/images/test2.webp', ImageFormat::WEBP, MimeType::IMAGE_WEBP],
            [__DIR__ . '/images/test-3.emf', ImageFormat::EMF, MimeType::IMAGE_X_EMF],
            [__DIR__ . '/images/test-alpha.heic', ImageFormat::HEIC, MimeType::IMAGE_HEIC],
            [__DIR__ . '/images/test-animated.gif', ImageFormat::GIF, MimeType::IMAGE_GIF],
            [__DIR__ . '/images/test-animation.heic', ImageFormat::HEIC_SEQUENCE, MimeType::IMAGE_HEIC],
            [__DIR__ . '/images/test-bmp24.bmp', ImageFormat::BMP, MimeType::IMAGE_BMP],
            [__DIR__ . '/images/test-bmp8.bmp', ImageFormat::BMP, MimeType::IMAGE_BMP],
            [__DIR__ . '/images/test-cin1.cin', ImageFormat::CIN, MimeType::IMAGE_CINEON],
            [__DIR__ . '/images/test-cin2.cin', ImageFormat::CIN, MimeType::IMAGE_CINEON],
            [__DIR__ . '/images/test-dng1.dng', ImageFormat::DNG, MimeType::IMAGE_X_ADOBE_DNG],
            [__DIR__ . '/images/test-dng2.dng', ImageFormat::DNG, MimeType::IMAGE_X_ADOBE_DNG],
            [__DIR__ . '/images/test-emf-plus.emf', ImageFormat::EMF_PLUS, MimeType::IMAGE_X_EMF],
            [__DIR__ . '/images/test-hdr.jpg', ImageFormat::JPEG_HDR, MimeType::IMAGE_JPEG],
            [__DIR__ . '/images/test-hdr1.hdr', ImageFormat::HDR, MimeType::IMAGE_VND_RADIANCE],
            [__DIR__ . '/images/test-iiro.orf', ImageFormat::ORF, MimeType::IMAGE_X_OLYMPUS_ORF],
            [__DIR__ . '/images/test-iirs.orf', ImageFormat::ORF, MimeType::IMAGE_X_OLYMPUS_ORF],
            [__DIR__ . '/images/test-mif1.heic', ImageFormat::HEIC, MimeType::IMAGE_HEIC],
            [__DIR__ . '/images/test-mmor.orf', ImageFormat::ORF, MimeType::IMAGE_X_OLYMPUS_ORF],
            [
                __DIR__ . '/images/test-panasonic-lumix-dmc-lx3-01.rw2',
                ImageFormat::RW2,
                MimeType::IMAGE_X_PANASONIC_RW_2,
            ],
            [__DIR__ . '/images/test-pfm.pfm', ImageFormat::PFM, MimeType::IMAGE_X_PORTABLE_FLOATMAP],
            [__DIR__ . '/images/test-phase-one.iiq', ImageFormat::TIFF, MimeType::IMAGE_TIFF],
            [__DIR__ . '/images/test-png24.png', ImageFormat::PNG, MimeType::IMAGE_PNG],
            [__DIR__ . '/images/test-png32.png', ImageFormat::PNG, MimeType::IMAGE_PNG],
            [__DIR__ . '/images/test-png8.png', ImageFormat::PNG, MimeType::IMAGE_PNG],
            [__DIR__ . '/images/test-raw.cr3', ImageFormat::CR3, MimeType::IMAGE_CR3],
            [__DIR__ . '/images/test-raw2.cr3', ImageFormat::CR3, MimeType::IMAGE_CR3],
            [__DIR__ . '/images/test-raw-pentax-k10D-srgb.pef', ImageFormat::PEF, MimeType::IMAGE_X_PENTAX_RAW],
            [__DIR__ . '/images/test-tiff24.tif', ImageFormat::TIFF, MimeType::IMAGE_TIFF],
            [__DIR__ . '/images/test-tiff32.tif', ImageFormat::TIFF, MimeType::IMAGE_TIFF],
            [__DIR__ . '/images/test-tiff8.tif', ImageFormat::TIFF, MimeType::IMAGE_TIFF],
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
