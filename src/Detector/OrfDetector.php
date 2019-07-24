<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeType;
use SplFileObject;

/**
 * Detector.
 */
final class OrfDetector implements DetectorInterface
{
    /**
     * ORF (Olympus) format identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $bytes = $file->fread(4);

        return $bytes === 'IIRO' || $bytes === 'MMOR' || $bytes === 'IIRS' ?
            new ImageType(ImageFormat::ORF, MimeType::IMAGE_X_OLYMPUS_ORF) : null;
    }
}
