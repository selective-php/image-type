<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageType;
use SplFileObject;

/**
 * Detector.
 */
final class CineonDetector implements DetectorInterface
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
        $file->rewind();
        $bytes = bin2hex($file->fread(4) ?: "");

        return $bytes === "802a5fd7" || $bytes === "d75f2a80" ? new ImageType(ImageType::CIN) : null;
    }
}
