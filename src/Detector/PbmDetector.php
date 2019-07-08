<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageType;
use SplFileObject;

/**
 * Detector.
 */
final class PbmDetector implements DetectorInterface
{
    /**
     * PBM identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $bytes = (string)$file->fread(2);

        return $bytes === 'P1' || $bytes === 'P4' ? new ImageType(ImageType::PBM) : null;
    }
}
