<?php

namespace Selective\ImageType\Provider;

use Selective\ImageType\Detector\AiDetector;
use Selective\ImageType\Detector\BmpDetector;
use Selective\ImageType\Detector\CurDetector;
use Selective\ImageType\Detector\GifDetector;
use Selective\ImageType\Detector\HeicDetector;
use Selective\ImageType\Detector\IcoDetector;
use Selective\ImageType\Detector\JpegDetector;
use Selective\ImageType\Detector\PngDetector;
use Selective\ImageType\Detector\PsdDetector;
use Selective\ImageType\Detector\SvgDetector;
use Selective\ImageType\Detector\SwfDetector;
use Selective\ImageType\Detector\TiffDetector;
use Selective\ImageType\Detector\WebpDetector;

/**
 * Provider.
 */
class DefaultProvider implements ProviderInterface
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
            new PsdDetector(),
            new SwfDetector(),
            new AiDetector(),
        ];
    }
}
