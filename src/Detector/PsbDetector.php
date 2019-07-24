<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeType;
use SplFileObject;

/**
 * Detector.
 */
final class PsbDetector implements DetectorInterface
{
    /**
     * PSB (Photoshop Large Document) identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        return $file->fread(6) === "8BPS\0\2" ? new ImageType(ImageFormat::PSB, MimeType::IMAGE_X_PSB) : null;
    }
}
