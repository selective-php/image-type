<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeType;
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
        return $file->fread(3) === "\0\0\1" ? new ImageType(ImageFormat::ICO, MimeType::IMAGE_X_ICON) : null;
    }
}
