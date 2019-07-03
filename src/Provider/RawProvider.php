<?php

namespace Selective\ImageType\Provider;

use Selective\ImageType\Detector\Cr2Detector;
use Selective\ImageType\Detector\Cr3Detector;
use Selective\ImageType\Detector\Fr3Detector;
use Selective\ImageType\Detector\OrfDetector;
use Selective\ImageType\Detector\PefDetector;
use Selective\ImageType\Detector\Rw2Detector;
use Selective\ImageType\Detector\DngDetector;
use Selective\ImageType\Detector\CineonDetector;
use Selective\ImageType\Detector\PfmDetector;

/**
 * Provider.
 */
class RawProvider implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDetectors(): array
    {
        return [
            new Cr3Detector(),
            new Cr2Detector(),
            new OrfDetector(),
            new PefDetector(),
            new Rw2Detector(),
            new Fr3Detector(),
            new DngDetector(),
            new CineonDetector(),
            new PfmDetector(),
        ];
    }
}
