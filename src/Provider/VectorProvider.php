<?php

namespace Selective\ImageType\Provider;

use Selective\ImageType\Detector\AiDetector;
use Selective\ImageType\Detector\EmfDetector;
use Selective\ImageType\Detector\EmfPlusDetector;
use Selective\ImageType\Detector\SvgDetector;
use Selective\ImageType\Detector\WmfDetector;

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
            new WmfDetector(),
            new EmfDetector(),
            new EmfPlusDetector(),
        ];
    }
}
