<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeType;
use SplFileObject;

/**
 * Detector.
 */
final class PefDetector implements DetectorInterface
{
    /**
     * PEF (Pentax) RAW format identification.
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

        $bytes = (string)$file->fread(510);

        return strpos($bytes, 'PENTAX') >= 6 ? new ImageType(ImageFormat::PEF, MimeType::IMAGE_X_PENTAX_RAW) : null;
    }
}
