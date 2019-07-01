<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageType;
use SplFileObject;

/**
 * Detector.
 */
final class BmpDetector implements DetectorInterface
{
    /**
     * BMP identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $file->rewind();

        return $file->fread(2) === 'BM' ? new ImageType(ImageType::BMP) : null;
    }
}