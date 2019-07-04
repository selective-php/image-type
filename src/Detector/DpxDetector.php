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
     * DPX identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $file->rewind();
        $bytes = (string)$file->fread(4);

        return $bytes === "SDPX" || $bytes === "XPDS" ? new ImageType(ImageType::DPX) : null;
    }
}
