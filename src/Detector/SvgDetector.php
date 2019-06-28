<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageType;
use SplFileObject;

/**
 * Detector.
 */
final class SvgDetector implements DetectorInterface
{
    /**
     * SVG identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $file->rewind();
        $bytes = $file->fread(4) ?: '';

        return strtolower($bytes) === '<svg' ? new ImageType(ImageType::SVG) : null;
    }
}
