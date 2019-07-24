<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeType;
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
        $bytes = (string)$file->fread(4);

        return strtolower($bytes) === '<svg' ? new ImageType(ImageFormat::SVG, MimeType::IMAGE_SVG_XML) : null;
    }
}
