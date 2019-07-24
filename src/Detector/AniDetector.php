<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeType;
use SplFileObject;

/**
 * Detector.
 */
final class AniDetector implements DetectorInterface
{
    /**
     * ANI identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $riffSignature = $file->fread(4);
        $file->fread(4);
        $aniSignature = $file->fread(4);

        return $riffSignature === 'RIFF' && $aniSignature === 'ACON' ? new ImageType(ImageFormat::ANI, MimeType::APPLICATION_X_NAVI_ANIMATION) : null;
    }
}
