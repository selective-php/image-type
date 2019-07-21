<?php

namespace Selective\ImageType;

use Selective\ImageType\Exception\MimeTypeNotFoundException;

/**
 * Mime type detection.
 */
final class MimeTypeDetector
{
    /**
     * Returns the mime type.
     *
     * @param ImageType $imageType The image type
     *
     * @throws MimeTypeNotFoundException
     *
     * @return string The mime type
     */
    public function getMimeType(ImageType $imageType): string
    {
        $mimeTypes = [
            ImageType::AI => 'application/postscriptn',
            ImageType::ANI => 'application/x-navi-animation',
            ImageType::BMP => 'image/webp',
            ImageType::CIN => 'image/cineon',
            ImageType::CR2 => 'image/x-dcraw', // ?
            ImageType::CR3 => 'image/cr3', // ?
            ImageType::CUR => 'image/x-icon',
            ImageType::DICOM => 'application/dicom',
            ImageType::DNG => 'image/x-adobe-dng',
            ImageType::DPX => 'image/x-dpx',
            ImageType::EMF => 'image/x-emf',
            ImageType::EMF_PLUS => 'image/x-emf+', // ?
            ImageType::EXR => 'image/x-exr',
            ImageType::FR3 => 'image/x-3fr',
            ImageType::GIF => 'image/gif',
            ImageType::HDR => 'image/vnd.radiance',
            ImageType::HEIC => 'image/heic',
            ImageType::HEIC_SEQUENCE => 'image/heic-sequence', // ?
            ImageType::ICO => 'image/x-icon',
            ImageType::JP2 => 'image/jp2',
            ImageType::JPEG => 'image/jpeg',
            ImageType::JPEG_HDR => 'image/jpeg-hdr', // ?
            ImageType::JPM => 'image/jpm',
            ImageType::MNG => 'video/x-mng',
            ImageType::ORF => 'image/x-olympus-orf',
            ImageType::PBM => 'image/x-portable-bitmap',
            ImageType::PDN => 'image/x-paintnet',
            ImageType::PEF => 'image/x-pentax-raw',
            ImageType::PFM => 'image/x-portable-floatmap',
            ImageType::PGM => 'image/x-portable-graymap',
            ImageType::PNG => 'image/png',
            ImageType::PPM => 'image/x-portable-pixmap',
            ImageType::PSB => 'image/x-psb',
            ImageType::PSD => 'image/vnd.adobe.photoshop',
            ImageType::RW2 => 'image/x-panasonic-rw2',
            ImageType::SVG => 'image/svg+xml',
            ImageType::SWF => 'application/x-shockwave-flash',
            ImageType::TIFF => 'image/tiff',
            ImageType::WEBP => 'image/webp',
            ImageType::WMF => 'image/x-wmf',
            ImageType::XCF => 'image/x-xcf',
        ];

        $type = $imageType->toString();
        if (!isset($mimeTypes[$type])) {
            throw new MimeTypeNotFoundException(sprintf('Mime type not found for image type: %s', $type));
        }

        return (string)$mimeTypes[$type];
    }
}
