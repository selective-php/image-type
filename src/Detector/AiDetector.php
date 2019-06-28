<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageType;
use SplFileObject;

/**
 * Detector.
 */
final class AiDetector implements DetectorInterface
{
    /**
     * Adobe Illustrator identification.
     *
     * http://www.idea2ic.com/File_Formats/Adobe%20Illustrator%20File%20Format.pdf#page=12
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $file->rewind();
        $bytes = $file->fread(10) ?: '';

        return $bytes === '%!PS-Adobe' ? new ImageType(ImageType::AI) : null;
    }
}
