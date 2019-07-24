<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeType;
use SplFileObject;

/**
 * Detector.
 */
final class DngDetector implements DetectorInterface
{
    /**
     * DNG identification.
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

        $file->fread(6);
        $bytes = (string)$file->fread(12);

        return ((strpos($bytes, "\x04") !== false || strpos($bytes, "\x02") !== false) &&
            strpos($bytes, "\x01") && substr_count($bytes, "\0") >= 2) ?
            new ImageType(ImageFormat::DNG, MimeType::IMAGE_X_ADOBE_DNG) : null;
    }
}
