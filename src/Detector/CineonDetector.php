<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeType;
use SplFileObject;

/**
 * Detector.
 */
final class CineonDetector implements DetectorInterface
{
    /**
     * CIN (Cineon Image File Format) identification.
     *
     * https://hwiegman.home.xs4all.nl/fileformats/dpx/Cineon%20Image%20File%20Format%20Draft%20and%20Data%20Structures.htm
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $bytes = bin2hex((string)$file->fread(4));

        return $bytes === '802a5fd7' || $bytes === 'd75f2a80' ? new ImageType(ImageFormat::CIN, MimeType::IMAGE_CINEON) : null;
    }
}
