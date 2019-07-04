<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageType;
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

        return $bytes === 'SDPX' || $bytes === 'XPDS' ? new ImageType(ImageType::DPX) : null;
    }
}
