<?php

namespace Selective\ImageType;

use SplFileInfo;
use SplFileObject;

/**
 * Image type detection.
 */
final class ImageTypeDetector
{
    /**
     * Detect image type.
     *
     * @param SplFileInfo $file The image file
     *
     * @return string The image type
     */
    public function getImageTypeFromFile(SplFileInfo $file): string
    {
        $realFile = $file->getRealPath();
        if ($realFile === false) {
            throw new ImageTypeException(sprintf('Image type could not be found: %s', $file->getPath()));
        }

        $stream = new SplFileObject($realFile);
        $type = $this->parseType($stream);
        unset($stream);

        if ($type === null) {
            throw new ImageTypeException(sprintf('Image type could not be detected: %s', $file->getRealPath()));
        }

        return $type;
    }

    /**
     * Reads and returns the type of the image.
     *
     * @param SplFileObject $file The image file
     *
     * @throws ImageTypeException
     *
     * @return string|null
     */
    private function parseType(SplFileObject $file): ?string
    {
        $type = null;
        $file->rewind();

        switch ($file->fread(2)) {
            case 'BM':
                return 'bmp';
            case 'GI':
                return 'gif';
            case chr(0xFF) . chr(0xd8):
                return 'jpeg';
            case "\0\0":
                //switch ($this->readByte($this->stream->peek(1))) {
                switch (ord($file->fread(2) ?: '')) {
                    case 1:
                        return 'ico';
                    case 2:
                        return 'cur';
                }

                return null;
            case chr(0x89) . 'P':
                return 'png';
            case 'RI':
                if (substr($file->fread(10) ?: '', 6, 4) === 'WEBP') {
                    return 'webp';
                }

                return null;
            case '8B':
                return 'psd';
            case 'II':
            case 'MM':
                return 'tiff';
            default:
                $file->rewind();

                // Keep reading bytes until we find '<svg'.
                while (true) {
                    $byte = $file->fread(1);
                    if ('<' === $byte && 'svg' === $file->fread(3)) {
                        return 'svg';
                    }
                }
        }

        return null;
    }
}
