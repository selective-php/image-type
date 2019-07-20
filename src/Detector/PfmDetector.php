<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageType;
use SplFileObject;

/**
 * Detector.
 */
final class PfmDetector implements DetectorInterface
{
    /**
     * PFM Portable Float Map (HDR) identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $bytes = strtoupper((string)$file->fread(2));

        return $bytes === 'PF' ? new ImageType(ImageType::PFM) : null;
    }
}
