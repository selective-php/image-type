<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageType;
use SplFileObject;

/**
 * Detector.
 */
final class Cr3Detector implements DetectorInterface
{
    /**
     * CR3 (Canon) RAW format detection.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $file->rewind();
        $file->fread(4);

        $bytes = $file->fread(7);

        return $bytes === 'ftypcrx' ? new ImageType(ImageType::CR3) : null;
    }
}
