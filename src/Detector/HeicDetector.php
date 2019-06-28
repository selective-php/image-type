<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageType;
use SplFileObject;

/**
 * Detector.
 */
final class HeicDetector implements DetectorInterface
{
    /**
     * HEIC identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null The image type
     */
    public function detect(SplFileObject $file): ?ImageType
    {
        $file->rewind();

        // Skip first 4 bytes
        $file->fread(4);

        // Use ftyp(heic|heix|...|mif1) as magic bytes

        // Read magic bytes
        $bytes = $file->fread(4) ?: '';

        // Read major brand and minor version
        $ccCode = $file->fread(4) ?: '';

        // Source: https://github.com/strukturag/libheif/issues/83
        $ccCodes = [
            // Usual HEIF images
            'heic' => 1,
            // 10bit images, or anything that uses h265 with range extension
            'heix' => 1,
            // Brands for image sequences
            'hevc' => 1,
            'hevx' => 1,
            // Multiview
            'heim' => 1,
            // Scalable
            'heis' => 1,
            // Multiview sequence
            'hevm' => 1,
            // Scalable sequence
            'hevs' => 1,
            // Special brands
            'mif1' => 1,
            // Equivalent case for image sequences
            'msf1' => 1,
        ];

        return $bytes === 'ftyp' && isset($ccCodes[$ccCode]) ? new ImageType(ImageType::HEIC) : null;
    }
}
