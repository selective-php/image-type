<?php

namespace Selective\ImageType\Provider;

use Selective\ImageType\Detector\Cr2Detector;
use Selective\ImageType\Detector\Cr3Detector;
use Selective\ImageType\Detector\Fr3Detector;
use Selective\ImageType\Detector\OrfDetector;
use Selective\ImageType\Detector\PefDetector;
use Selective\ImageType\Detector\Rw2Detector;
use Selective\ImageType\Detector\DngDetector;

/**
 * Provider.
 *
 * CIFF DNG
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
        ];
    }
}
