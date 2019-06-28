<?php

namespace Selective\ImageType\Provider;

use Selective\ImageType\Detector\DetectorInterface;

interface ProviderInterface
{
    /**
     * Return list of detectors.
     *
     * @return DetectorInterface[] The list
     */
    public function getDetectors(): array;
}
