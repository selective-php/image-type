<?php

namespace Selective\ImageType\Detector;

use Selective\ImageType\ImageFormat;
use Selective\ImageType\ImageType;
use Selective\ImageType\MimeType;
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
            'heic' => ImageFormat::HEIC,
            // 10bit images, or anything that uses h265 with range extension
            'heix' => ImageFormat::HEIC,
            // Brands for image sequences
            'hevc' => ImageFormat::HEIC_SEQUENCE,
            'hevx' => ImageFormat::HEIC_SEQUENCE,
            // Multiview
            'heim' => ImageFormat::HEIC,
            // Scalable
            'heis' => ImageFormat::HEIC,
            // Multiview sequence
            'hevm' => ImageFormat::HEIC_SEQUENCE,
            // Scalable sequence
            'hevs' => ImageFormat::HEIC_SEQUENCE,
            // Special brands
            'mif1' => ImageFormat::HEIC,
            // Equivalent case for image sequences
            'msf1' => ImageFormat::HEIC_SEQUENCE,
        ];

        return $bytes === 'ftyp' && isset($ccCodes[$ccCode]) ? new ImageType($ccCodes[$ccCode], MimeType::IMAGE_HEIC) : null;
    }
}
