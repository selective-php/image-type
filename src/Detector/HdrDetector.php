<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeType;
use SplFileObject;

/**
 * Detector.
 */
final class HdrDetector implements DetectorInterface
{
    /**
     * Radiance (HDR) identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $bytes = (string)$file->fread(10);

        return $bytes === '#?RADIANCE' || $bytes === '#?RGBE' ? new ImageType(ImageFormat::HDR, MimeType::IMAGE_VND_RADIANCE) : null;
    }
}
