<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageType;
use SplFileObject;

/**
 * Detector.
 */
final class PpmDetector implements DetectorInterface
{
    /**
     * PPM identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $bytes = (string)$file->fread(2);

        return $bytes === 'P6' ? new ImageType(ImageType::PPM) : null;
    }
}
