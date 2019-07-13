<?php

namespace Selective\ImageType\Provider;

use Selective\ImageType\Detector\CineonDetector;
use Selective\ImageType\Detector\DpxDetector;
use Selective\ImageType\Detector\ExrDetector;
use Selective\ImageType\Detector\JpegHdrDetector;
use Selective\ImageType\Detector\PbmDetector;
use Selective\ImageType\Detector\PfmDetector;
use Selective\ImageType\Detector\HdrDetector;

/**
 * Provider.
 */
class HdrProvider implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDetectors(): array
    {
        return [
            new CineonDetector(),
            new PfmDetector(),
            new DpxDetector(),
            new PbmDetector(),
            new PbmDetector(),
            new HdrDetector(),
            new JpegHdrDetector(),
            new ExrDetector(),
        ];
    }
}
