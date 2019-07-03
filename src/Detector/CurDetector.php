<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageType;
use SplFileObject;

/**
 * Detector.
 */
final class CurDetector implements DetectorInterface
{
    /**
     * CUR identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        return $file->fread(3) === "\0\0\2" ? new ImageType(ImageType::CUR) : null;
    }
}
