<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeType;
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

        return $bytes === 'ftypjp2' ? new ImageType(ImageFormat::JP2, MimeType::IMAGE_JP2) : null;
    }
}
