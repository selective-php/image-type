<?php

namespace Selective\ImageType;

use Selective\ImageType\Detector\DetectorInterface;
use Selective\ImageType\Provider\ProviderInterface;
use SplFileObject;

/**
 * Image type detection.
 */
final class ImageTypeDetector
{
    /**
     * @var DetectorInterface[]
     */
    private $detectors = [];

    /**
     * Add image detector.
     *
     * @param DetectorInterface $detector The detector
     */
    public function addDetector(DetectorInterface $detector): void
    {
        $this->detectors[] = $detector;
    }

    /**
     * Add image detector provider.
     *
     * @param ProviderInterface $provider The provider
     *
     * @return void
     */
    public function addProvider(ProviderInterface $provider): void
    {
        foreach ($provider->getDetectors() as $detector) {
            $this->addDetector($detector);
        }
    }

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
        $type = $this->detectFile($file);

        if ($type === null) {
            throw new ImageTypeDetectorException('Image type could not be detected');
        }

        return $type;
    }

    /**
     * Reads and returns the type of the image.
     *
     * @param SplFileObject $file The image file
     *
     * @return ImageType|null
     */
    private function detectFile(SplFileObject $file): ?ImageType
    {
        foreach ($this->detectors as $detector) {
            $file->rewind();

            $type = $detector->detect($file);

            if ($type !== null) {
                return $type;
            }
        }

        return null;
    }
}
