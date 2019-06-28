<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageType;
use SplFileObject;

/**
 * Detector.
 */
final class IcoDetector implements DetectorInterface
{
    /**
     * ICO identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $file->rewind();

        return $file->fread(3) === "\0\0\1" ? new ImageType(ImageType::ICO) : null;
    }
}
