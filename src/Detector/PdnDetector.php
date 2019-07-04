<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageType;
use SplFileObject;

/**
 * Detector.
 */
final class PdnDetector implements DetectorInterface
{
    /**
     * PDN Paint.NET format identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        return (string)$file->fread(4) === 'PDN3' ? new ImageType(ImageType::PDN) : null;
    }
}
