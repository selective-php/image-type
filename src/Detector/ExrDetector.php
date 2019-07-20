<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageType;
use SplFileObject;

/**
 * Detector.
 */
final class ExrDetector implements DetectorInterface
{
    /**
     * OpenEXR identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $bytes = (string)$file->fread(4);

        return bin2hex($bytes) === '762f3101' ? new ImageType(ImageType::EXR) : null;
    }
}
