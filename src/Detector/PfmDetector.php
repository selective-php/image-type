<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeType;
use SplFileObject;

/**
 * Detector.
 */
final class PfmDetector implements DetectorInterface
{
    /**
     * PFM Portable Float Map (HDR) identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $bytes = strtoupper((string)$file->fread(2));

        return $bytes === 'PF' ? new ImageType(ImageFormat::PFM, MimeType::IMAGE_X_PORTABLE_FLOATMAP) : null;
    }
}
