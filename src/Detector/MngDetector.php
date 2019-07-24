<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeType;
use SplFileObject;

/**
 * Detector.
 */
final class MngDetector implements DetectorInterface
{
    /**
     * MNG (Multiple-image Network Graphics) identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        return $file->fread(8) === "\x8A\x4D\x4E\x47\x0D\x0A\x1A\x0A" ?
            new ImageType(ImageFormat::MNG, MimeType::VIDEO_X_MNG) : null;
    }
}
