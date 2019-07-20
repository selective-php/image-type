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

    public const AI = 'ai';
    public const ANI = 'ani';
    public const BMP = 'bmp';
    public const CIN = 'cin';
    public const CR2 = 'cr2';
    public const CR3 = 'cr3';
    public const CUR = 'cur';
    public const DICOM = 'dcm';
    public const DNG = 'dng';
    public const DPX = 'dpx';
    public const EMF = 'emf';
    public const EMF_PLUS = 'emf+';
    public const EXR = 'exr';
    public const FR3 = '3FR';
    public const GIF = 'gif';
    public const HDR = 'hdr';
    public const HEIC = 'heic';
    public const HEIC_SEQUENCE = 'heic-sequence';
    public const ICO = 'ico';
    public const JP2 = 'jp2';
    public const JPEG = 'jpeg';
    public const JPEG_HDR = 'jpeg';
    public const JPM = 'jpm';
    public const MNG = 'mng';
    public const ORF = 'orf';
    public const PBM = 'pbm';
    public const PDN = 'pdn';
    public const PEF = 'pef';
    public const PFM = 'pfm';
    public const PGM = 'pgm';
    public const PNG = 'png';
    public const PPM = 'ppm';
    public const PSB = 'psb';
    public const PSD = 'psd';
    public const RW2 = 'rw2';
    public const SVG = 'svg';
    public const SWF = 'swf';
    public const TIFF = 'tiff';
    public const WEBP = 'webp';
    public const WMF = 'wmf';
    public const XCF = 'xcf';

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
