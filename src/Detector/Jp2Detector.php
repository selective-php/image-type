<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageType;
use SplFileObject;

/**
 * Detector.
 */
final class Jp2Detector implements DetectorInterface
{
    /**
     * JPEG 2000 identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $file->fread(16);
        $bytes = (string)$file->fread(7);

        return $bytes === 'ftypjp2' ? new ImageType(ImageType::JP2) : null;
    }
}
