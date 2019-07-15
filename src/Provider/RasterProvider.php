<?php

namespace Selective\ImageType\Provider;

use Selective\ImageType\Detector\AiDetector;
use Selective\ImageType\Detector\AniDetector;
use Selective\ImageType\Detector\BmpDetector;
use Selective\ImageType\Detector\CurDetector;
use Selective\ImageType\Detector\DcmDetector;
use Selective\ImageType\Detector\GifDetector;
use Selective\ImageType\Detector\HeicDetector;
use Selective\ImageType\Detector\IcoDetector;
use Selective\ImageType\Detector\Jp2Detector;
use Selective\ImageType\Detector\JpegDetector;
use Selective\ImageType\Detector\JpmDetector;
use Selective\ImageType\Detector\MngDetector;
use Selective\ImageType\Detector\PdnDetector;
use Selective\ImageType\Detector\PngDetector;
use Selective\ImageType\Detector\PsbDetector;
use Selective\ImageType\Detector\PsdDetector;
use Selective\ImageType\Detector\SvgDetector;
use Selective\ImageType\Detector\SwfDetector;
use Selective\ImageType\Detector\TiffDetector;
use Selective\ImageType\Detector\WebpDetector;
use Selective\ImageType\Detector\XcfDetector;
use Selective\ImageType\Detector\PgmDetector;
use Selective\ImageType\Detector\PpmDetector;

/**
 * Raster Provider.
 *
 * ANI ANIM APNG ART BMP BPG BSAVE CAL CIN CPC CPT DDS DPX ECW FITS FLIC
 * FLIF FPX GIF HDRi HEVC ICER ICNS ICO / CUR ICS ILBM JBIG JBIG2 JNG JPEG
 * JPEG-LS JPEG 2000 JPEG XR JPEG XT JPEG-HDR KRA MNG MIFF NRRD ORA PAM
 * PBM / PGM / PPM / PNM PCX PGF PICtor PNG PSD / PSB PSP QTVR RAS
 * RGBE Logluv TIFF SGI TGA TIFF TIFF/EP TIFF/IT UFO/ UFP WBMP
 * WebP XBM XCF XPM XWD
 */
class RasterProvider implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDetectors(): array
    {
        return [
            new JpegDetector(),
            new PngDetector(),
            new GifDetector(),
            new TiffDetector(),
            new SvgDetector(),
            new WebpDetector(),
            new BmpDetector(),
            new HeicDetector(),
            new CurDetector(),
            new IcoDetector(),
            new AniDetector(),
            new PsdDetector(),
            new SwfDetector(),
            new AiDetector(),
            new Jp2Detector(),
            new PdnDetector(),
            new JpmDetector(),
            new DcmDetector(),
            new XcfDetector(),
            new MngDetector(),
            new PsbDetector(),
            new PgmDetector(),
            new PpmDetector(),
        ];
    }
}
