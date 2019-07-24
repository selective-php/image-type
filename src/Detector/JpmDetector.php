<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeType;
use SplFileObject;

/**
 * Detector.
 */
final class JpmDetector implements DetectorInterface
{
    /**
     * JPEG identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $bytes = bin2hex((string)$file->fread(24));

        return $bytes === '0000000c6a5020200d0a870a00000014667479706a706d20' ?
            new ImageType(ImageFormat::JPM, MimeType::IMAGE_JPM) : null;
    }
}
