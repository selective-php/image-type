<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageType;
use SplFileObject;

/**
 * Detector.
 */
final class PngDetector implements DetectorInterface
{
    /**
     * PNG identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $file->rewind();

        return$file->fread(4) === chr(0x89) . 'PNG' ? new ImageType(ImageType::PNG) : null;
    }
}
