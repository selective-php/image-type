<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeType;
use SplFileObject;

/**
 * Detector.
 */
final class Fr3Detector implements DetectorInterface
{
    /**
     * Hasselblad 3FR RAW format identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $bytes = $file->fread(2);

        // TIFF header
        if ($bytes !== 'II' && $bytes !== 'MM') {
            return null;
        }

        $bytes = (string)$file->fread(512);

        return strpos($bytes, 'Hasselblad') > 10 ? new ImageType(ImageFormat::FR3, MimeType::IMAGE_X_3_FR) : null;
    }
}
