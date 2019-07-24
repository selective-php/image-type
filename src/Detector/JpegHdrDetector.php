<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeType;
use SplFileObject;

/**
 * Detector.
 */
final class JpegHdrDetector implements DetectorInterface
{
    /**
     * JPEG-HDR identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $bytes = (string)$file->fread(50);

        return (strpos($bytes, 'HDR_RI') !== false && strpos($bytes, 'ver=11') !== false) ?
            new ImageType(ImageFormat::JPEG_HDR, MimeType::IMAGE_JPEG) : null;
    }
}
