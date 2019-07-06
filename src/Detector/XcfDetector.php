<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageType;
use SplFileObject;

/**
 * Detector.
 */
final class XcfDetector implements DetectorInterface
{
    /**
     * XCF - eXperimental Computing Facility (GIMP) identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        return $file->fread(9) === 'gimp xcf ' ? new ImageType(ImageType::XCF) : null;
    }
}
