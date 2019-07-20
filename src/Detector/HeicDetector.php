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
            'heic' => ImageType::HEIC,
            // 10bit images, or anything that uses h265 with range extension
            'heix' => ImageType::HEIC,
            // Brands for image sequences
            'hevc' => ImageType::HEIC_SEQUENCE,
            'hevx' => ImageType::HEIC_SEQUENCE,
            // Multiview
            'heim' => ImageType::HEIC,
            // Scalable
            'heis' => ImageType::HEIC,
            // Multiview sequence
            'hevm' => ImageType::HEIC_SEQUENCE,
            // Scalable sequence
            'hevs' => ImageType::HEIC_SEQUENCE,
            // Special brands
            'mif1' => ImageType::HEIC,
            // Equivalent case for image sequences
            'msf1' => ImageType::HEIC_SEQUENCE,
        ];

        return $bytes === 'ftyp' && isset($ccCodes[$ccCode]) ? new ImageType($ccCodes[$ccCode]) : null;
    }
}
