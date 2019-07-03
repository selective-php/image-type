<?php

namespace Selective\ImageType\Provider;

use Selective\ImageType\Detector\SwfDetector;

/**
 * Compound formats.
 *
 * CDF DjVu EPS PDF PICT PS SWF XAML.
 */
class CompoundProvider implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDetectors(): array
    {
        return [
            new SwfDetector(),
        ];
    }
}
