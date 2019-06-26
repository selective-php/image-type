<?php

namespace Selective\ImageType;

use SplFileObject;

/**
 * Image type detection.
 */
final class ImageTypeDetector
{
    /**
     * Detect image type.
     *
     * @param SplFileObject $file The image file
     *
     * @throws ImageTypeDetectorException
     *
     * @return ImageType The image type
     */
    public function getImageTypeFromFile(SplFileObject $file): ImageType
    {
        $type = $this->parseType($file);

        if ($type === null) {
            throw new ImageTypeDetectorException('Image type could not be detected');
        }

        return new ImageType($type);
    }

    /**
     * Reads and returns the type of the image.
     *
     * @param SplFileObject $file The image file
     *
     * @return string|null
     */
    private function parseType(SplFileObject $file): ?string
    {
        foreach ($this->getDetectors() as $detector) {
            $type = $detector($file);

            if ($type !== null) {
                return $type;
            }
        }

        return null;
    }

    /**
     * Get array with detectors.
     *
     * @return array The detector callbacks
     */
    private function getDetectors(): array
    {
        return [
            function (SplFileObject $file) {
                return $this->detectBasicTypes($file);
            },
            function (SplFileObject $file) {
                return $this->detectPng($file);
            },
            function (SplFileObject $file) {
                return $this->detectWebp($file);
            },
            function (SplFileObject $file) {
                return $this->detectSvg($file);
            },
            function (SplFileObject $file) {
                return $this->detectTiff($file);
            },
            function (SplFileObject $file) {
                return $this->detectIcoAndCur($file);
            },
            function (SplFileObject $file) {
                return $this->detectAi($file);
            },
            function (SplFileObject $file) {
                return $this->detectSwf($file);
            },
            function (SplFileObject $file) {
                return $this->detectHeic($file);
            },
            function (SplFileObject $file) {
                return $this->detectCr3($file);
            },
        ];
    }

    /**
     * Simple image detection.
     *
     * @param SplFileObject $file The image file
     *
     * @return string|null The image type
     */
    private function detectBasicTypes(SplFileObject $file): ?string
    {
        $file->rewind();
        $bytes = $file->fread(2);

        // Mapping
        $magicBytes = [
            'BM' => ImageType::BMP,
            'GI' => ImageType::GIF,
            chr(0xFF) . chr(0xd8) => ImageType::JPEG,
            '8B' => ImageType::PSD,
        ];

        if (isset($magicBytes[$bytes])) {
            return (string)$magicBytes[$bytes];
        }

        return null;
    }

    /**
     * Image detection.
     *
     * @param SplFileObject $file The image file
     *
     * @return string|null The image type
     */
    private function detectPng(SplFileObject $file): ?string
    {
        $file->rewind();

        return $file->fread(4) === chr(0x89) . 'PNG' ? ImageType::PNG : null;
    }

    /**
     * Detect ICO and CUR file format.
     *
     * @param SplFileObject $file The image file
     *
     * @return string|null The image type
     */
    private function detectIcoAndCur(SplFileObject $file): ?string
    {
        $file->rewind();
        $bytes = $file->fread(3);

        if ($bytes === "\0\0\1") {
            return ImageType::ICO;
        }

        if ($bytes === "\0\0\2") {
            return ImageType::CUR;
        }

        return null;
    }

    /**
     * Image detection.
     *
     * @param SplFileObject $file The image file
     *
     * @return string|null The image type
     */
    private function detectWebp(SplFileObject $file): ?string
    {
        $file->rewind();
        $bytes = $file->fread(12) ?: '';

        return substr($bytes, 8, 4) === 'WEBP' ? ImageType::WEBP : null;
    }

    /**
     * Image detection.
     *
     * @param SplFileObject $file The image file
     *
     * @return string|null The image type
     */
    private function detectSvg(SplFileObject $file): ?string
    {
        $file->rewind();
        $bytes = $file->fread(4) ?: '';

        return strtolower($bytes) === '<svg' ? ImageType::SVG : null;
    }

    /**
     * Adobe Illustrator detection.
     *
     * http://www.idea2ic.com/File_Formats/Adobe%20Illustrator%20File%20Format.pdf#page=12
     *
     * @param SplFileObject $file The image file
     *
     * @return string|null The image type
     */
    private function detectAi(SplFileObject $file): ?string
    {
        $file->rewind();
        $bytes = $file->fread(10) ?: '';

        return $bytes === '%!PS-Adobe' ? ImageType::AI : null;
    }

    /**
     * Adobe Flash detection.
     *
     * https://www.adobe.com/content/dam/acom/en/devnet/pdf/swf-file-format-spec.pdf#page=27
     *
     * @param SplFileObject $file The image file
     *
     * @return string|null The image type
     */
    private function detectSwf(SplFileObject $file): ?string
    {
        $file->rewind();
        $compression = $file->fread(1) ?: '';
        $signature = $file->fread(2) ?: '';

        $compressions = [
            'F' => 1,
            'C' => 1,
            'Z' => 1,
        ];

        return $signature === 'WS' && isset($compressions[$compression]) ? ImageType::SWF : null;
    }

    /**
     * HEIC detection.
     *
     * @param SplFileObject $file The image file
     *
     * @return string|null The image type
     */
    private function detectHeic(SplFileObject $file): ?string
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

        return $bytes === 'ftyp' && isset($ccCodes[$ccCode]) ? ImageType::HEIC : null;
    }

    /**
     * CR3 detection.
     *
     * @param SplFileObject $file The image file
     *
     * @return string|null The image type
     */
    private function detectCr3(SplFileObject $file): ?string
    {
        $file->rewind();

        $file->fread(4);

        $bytes = $file->fread(7);

        return $bytes === 'ftypcrx' ? ImageType::CR3 : null;
    }

    /**
     * TIFF and TIFF based RAW image identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return string|null The image type
     */
    private function detectTiff(SplFileObject $file): ?string
    {
        $file->rewind();
        $bytes = $file->fread(2);

        if ($bytes !== 'II' && $bytes !== 'MM') {
            return null;
        }

        $result = ImageType::TIFF;

        // TIFF based RAW images
        $result = $this->detectRw2($file) ?? $result;
        $result = $this->detectPef($file) ?? $result;

        return $result;
    }

    /**
     * RW2 (Panasonic ) RAW format identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return string|null The image type
     */
    private function detectRw2(SplFileObject $file): ?string
    {
        $file->rewind();
        $bytes = $file->fread(4);

        return $bytes === "IIU\0" ? ImageType::RW2 : null;
    }

    /**
     * PEF (Pentax) RAW format identification.
     *
     * @param SplFileObject $file The image file
     *
     * @return string|null The image type
     */
    private function detectPef(SplFileObject $file): ?string
    {
        $file->rewind();
        $bytes = $file->fread(4);

        return $bytes === "MM\0*" ? ImageType::PEF : null;
    }
}
