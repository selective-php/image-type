<?php

namespace Selective\ImageType\Provider;

use Selective\ImageType\Detector\AiDetector;
use Selective\ImageType\Detector\SvgDetector;

/**
 * Vector formats.
 */
class VectorProvider implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDetectors(): array
    {
        return [
            new SvgDetector(),
            new AiDetector(),
        ];
    }
}
