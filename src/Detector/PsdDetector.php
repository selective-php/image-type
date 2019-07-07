<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageType;
use SplFileObject;

/**
 * Detector.
 */
final class PsdDetector implements DetectorInterface
{
    /**
     * PSD identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        return $file->fread(6) === "8BPS\0\1"  ? new ImageType(ImageType::PSD) : null;
    }
}
