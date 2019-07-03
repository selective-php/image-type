<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageType;
use SplFileObject;

/**
 * Detector.
 */
final class WmfDetector implements DetectorInterface
{
    /**
     * WMF identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $bytes = (string)$file->fread(4);

        return $bytes === "\xd7\xcd\xc6\x9a" ? new ImageType(ImageType::WMF) : null;
    }
}
