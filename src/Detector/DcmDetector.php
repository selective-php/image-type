<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageType;
use SplFileObject;

/**
 * Detector.
 */
final class DcmDetector implements DetectorInterface
{
    /**
     * DCM / DICOM identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $file->fread(128);

        return $file->fread(4) === 'DICM' ? new ImageType(ImageType::DICOM) : null;
    }
}
