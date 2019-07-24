<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeType;
use SplFileObject;

/**
 * Detector.
 */
final class DpxDetector implements DetectorInterface
{
    /**
     * DPX Digital Picture Exchange identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $bytes = (string)$file->fread(4);

        return $bytes === 'SDPX' || $bytes === 'XPDS' ? new ImageType(ImageFormat::DPX, MimeType::IMAGE_X_DPX) : null;
    }
}
