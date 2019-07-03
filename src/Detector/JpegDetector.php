<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageType;
use SplFileObject;

/**
 * Detector.
 */
final class JpegDetector implements DetectorInterface
{
    /**
     * JPEG identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        return $file->fread(2) === chr(0xFF) . chr(0xd8) ? new ImageType(ImageType::JPEG) : null;
    }
}
