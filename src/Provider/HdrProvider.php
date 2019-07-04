<?php

namespace Selective\ImageType\Provider;

use Selective\ImageType\Detector\CineonDetector;
use Selective\ImageType\Detector\DpxDetector;
use Selective\ImageType\Detector\PfmDetector;

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
        ];
    }
}
