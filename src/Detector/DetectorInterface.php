<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageType;
use SplFileObject;

/**
 * Detector.
 */
interface DetectorInterface
{
    /**
     * Detect.
     *
     * @param SplFileObject $file The file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType;
}
