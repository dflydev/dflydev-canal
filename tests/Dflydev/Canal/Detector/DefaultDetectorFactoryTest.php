<?php

namespace Dflydev\Canal\Detector;

use PHPUnit\Framework\TestCase;

class DefaultDetectorFactoryTest extends TestCase
{
    public function testCreate()
    {
        $detector = DefaultDetectorFactory::create();

        $this->assertInstanceOf(DetectorInterface::class, $detector);
        $this->assertInstanceOf(ApacheMimeTypesExtensionDetector::class, $detector);
    }
}
