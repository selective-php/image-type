<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeType;
use SplFileObject;

/**
 * Detector.
 */
final class SwfDetector implements DetectorInterface
{
    /**
     * SWF (Flash) identification.
     *
     * https://www.adobe.com/content/dam/acom/en/devnet/pdf/swf-file-format-spec.pdf#page=27
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $compression = (string)$file->fread(1);
        $signature = (string)$file->fread(2);

        $compressions = [
            'F' => 1,
            'C' => 1,
            'Z' => 1,
        ];

        return $signature === 'WS' && isset($compressions[$compression]) ?
            new ImageType(ImageFormat::SWF, MimeType::APPLICATION_X_SHOCKWAVE_FLASH) : null;
    }
}
