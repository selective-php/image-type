<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageType;
use SplFileObject;

/**
 * Detector.
 */
final class TiffDetector implements DetectorInterface
{
    /**
     * TIFF image identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $bytes = $file->fread(2);

        return $bytes === 'II' || $bytes === 'MM' ? new ImageType(ImageType::TIFF) : null;
    }
}
