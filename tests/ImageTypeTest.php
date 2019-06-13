<?php

namespace Selective\ImageType\Test;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Selective\ImageType\ImageType;

/**
 * Test.
 */
class ImageTypeTest extends TestCase
{
    /**
     * Test.
     *
     * @dataProvider providerCreateInstance
     *
     * @param string $type The type
     * @param string $expected The expected value
     *
     * @return void
     */
    public function testCreateInstance(string $type, string $expected): void
    {
        $imageType = new ImageType($type);

        $this->assertSame((string)$imageType, $expected);
        $this->assertSame($imageType->__toString(), $imageType->toString());
    }

    /**
     * Provider.
     *
     * @return array Data
     */
    public function providerCreateInstance(): array
    {
        $class = new ReflectionClass(ImageType::class);

        $constants = $class->getConstants();

        $data = [];
        foreach ($constants as $constant) {
            $data[] = [
                $constant,
                $constant,
            ];
        }

        return $data;
    }

    /**
     * Test.
     *
     * @return void
     */
    public function testCreateInstanceWithError(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new ImageType('');
    }
}
