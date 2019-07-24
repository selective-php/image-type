<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeType;
use SplFileObject;

/**
 * Detector.
 */
final class EmfDetector implements DetectorInterface
{
    /**
     * EMF identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $emrHeader = (string)$file->fread(4);

        if ($emrHeader !== "\1\0\0\0") {
            return null;
        }

        $commentOffset = ord((string)$file->fread(1));
        $file->rewind();
        $file->fread(40);
        $emfSignature = (string)$file->fread(4);
        $hasEmf = $emfSignature === ' EMF';

        $file->rewind();
        $file->fread($commentOffset + 12);
        $emfPlusSignature = (string)$file->fread(4);
        $hasEmfPlus = $emfPlusSignature === 'EMF+';

        return $hasEmf && !$hasEmfPlus ? new ImageType(ImageFormat::EMF, MimeType::IMAGE_X_EMF) : null;
    }
}
