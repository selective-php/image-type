<?php

namespace Selective\ImageType;

use InvalidArgumentException;

/**
 * Image format constants.
 */
class ImageType
{
    /**
     * @var string The value
     */
    private $type;

    public const JPEG = 'jpeg';
    public const GIF = 'gif';
    public const PNG = 'png';
    public const WEBP = 'webp';
    public const BMP = 'bmp';
    public const PSD = 'psd';
    public const TIFF = 'tiff';
    public const SVG = 'svg';
    public const ICO = 'ico';
    public const CUR = 'cur';
    public const SWF = 'swf';
    public const AI = 'ai';
    public const HEIC = 'heic';
    public const CR2 = 'cr2';
    public const CR3 = 'cr3';
    public const RW2 = 'rw2';
    public const PEF = 'pef';
    public const FR3 = '3FR';
    public const ORF = 'orf';
    public const DNG = 'dng';
    public const CIN = 'cin';
    public const PFM = 'pfm';

    /**
     * ImageType constructor.
     *
     * @param string $type The image format
     */
    public function __construct(string $type)
    {
        if (empty($type)) {
            throw new InvalidArgumentException(sprintf('Invalid type: %s', $type));
        }

        $this->type = $type;
    }

    /**
     * Format to string.
     *
     * @return string The type
     */
    public function toString(): string
    {
        return $this->type;
    }

    /**
     * Format to string.
     *
     * @return string The type
     */
    public function __toString()
    {
        return $this->toString();
    }

    /**
     * Compare with other image type.
     *
     * @param ImageType $other The other type
     *
     * @return bool Status
     */
    public function equals(ImageType $other): bool
    {
        return $this->type === $other->type;
    }
}
