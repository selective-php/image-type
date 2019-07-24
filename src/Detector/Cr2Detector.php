<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeType;
use SplFileObject;

/**
 * Detector.
 */
final class Cr2Detector implements DetectorInterface
{
    /**
     * CR2 Canon RAW format identification.
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

        $bytes = $file->fread(8);

        return $bytes === "\x2a\0\x10\0\0\0CR" ? new ImageType(ImageFormat::CR2, MimeType::IMAGE_CR2) : null;
    }
}
