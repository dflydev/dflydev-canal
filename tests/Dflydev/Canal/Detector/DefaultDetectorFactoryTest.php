<?php

namespace Dflydev\Canal\Detector;

class DefaultDetectorFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $detector = DefaultDetectorFactory::create();

        $this->assertInstanceOf('Dflydev\Canal\Detector\DetectorInterface', $detector);
        $this->assertInstanceOf('Dflydev\Canal\Detector\ApacheMimeTypesExtensionDetector', $detector);
    }
}
