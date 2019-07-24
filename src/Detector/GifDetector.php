<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeType;
use SplFileObject;

/**
 * Detector.
 */
final class GifDetector implements DetectorInterface
{
    /**
     * GIF identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        return $file->fread(2) === 'GI' ? new ImageType(ImageFormat::GIF, MimeType::IMAGE_GIF) : null;
    }
}
