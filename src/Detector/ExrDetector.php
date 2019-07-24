<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeType;
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

        return bin2hex($bytes) === '762f3101' ? new ImageType(ImageFormat::EXR, MimeType::IMAGE_X_EXR) : null;
    }
}
