<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeType;
use SplFileObject;

/**
 * Detector.
 */
final class PgmDetector implements DetectorInterface
{
    /**
     * PBM identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $bytes = (string)$file->fread(2);

        return $bytes === 'P2' || $bytes === 'P5' ?
            new ImageType(ImageFormat::PGM, MimeType::IMAGE_X_PORTABLE_GRAYMAP) : null;
    }
}
