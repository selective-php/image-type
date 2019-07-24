<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeType;
use SplFileObject;

/**
 * Detector.
 */
final class Rw2Detector implements DetectorInterface
{
    /**
     * RW2 (Panasonic) RAW format identification.
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

        $bytes = $file->fread(2);

        return $bytes === "U\0" ? new ImageType(ImageFormat::RW2, MimeType::IMAGE_X_PANASONIC_RW_2) : null;
    }
}
