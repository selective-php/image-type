<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageType;
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
        $file->rewind();
        $bytes = $file->fread(12) ?: '';

        return substr($bytes, 8, 4) === 'WEBP' ? new ImageType(ImageType::WEBP) : null;
    }
}
