<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageType;
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
        $file->fread(36);
        $emfSignature = (string)$file->fread(4);
        $hasEmf = $emfSignature === ' EMF';

        $emfPlusSignature = (string)$file->fread(512);
        $hasEmfPlus = strpos($emfPlusSignature, 'EMF+') !== false;

        return $emrHeader === "\1\0\0\0" && $hasEmf && !$hasEmfPlus ? new ImageType(ImageType::EMF) : null;
    }
}
