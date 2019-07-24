<?php

namespace Selective\ImageType;

use InvalidArgumentException;

/**
 * Image type value object.
 */
final class ImageType
{
    /**
     * @var string The image format
     */
    private $format;

    /**
     * @var string The mime type
     */
    private $mime;

    /**
     * ImageType constructor.
     *
     * @param string $format The image format
     * @param string $mime The mime type
     */
    public function __construct(string $format, string $mime)
    {
        if (empty($format)) {
            throw new InvalidArgumentException(sprintf('Invalid type: %s', $format));
        }

        if (empty($mime)) {
            throw new InvalidArgumentException(sprintf('Invalid mime type: %s', $format));
        }

        $this->format = $format;
        $this->mime = $mime;
    }

    /**
     * Get image format.
     *
     * @return string The image format
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * Get mime type.
     *
     * @return string The mime type
     */
    public function getMimeType(): string
    {
        return $this->mime;
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
        return $this->format === $other->format &&
            $this->mime === $other->mime;
    }
}
