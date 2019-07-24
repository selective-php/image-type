<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeType;
use SplFileObject;

/**
 * Detector.
 */
final class WebpDetector implements DetectorInterface
{
    /**
     * WEBP identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $bytes = (string)$file->fread(12);

        return substr($bytes, 8, 4) === 'WEBP' ? new ImageType(ImageFormat::WEBP, MimeType::IMAGE_WEBP) : null;
    }
}
