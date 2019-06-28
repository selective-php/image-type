<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageType;
use SplFileObject;

/**
 * Detector.
 */
final class Cr2Detector implements DetectorInterface
{
    /**
     * CR2 Cannon RAW format identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $file->rewind();
        $bytes = $file->fread(2);

        // TIFF header
        if ($bytes !== 'II' && $bytes !== 'MM') {
            return null;
        }

        $bytes = $file->fread(8);

        return $bytes === "\x2a\0\x10\0\0\0CR" ? new ImageType(ImageType::CR2) : null;
    }
}
