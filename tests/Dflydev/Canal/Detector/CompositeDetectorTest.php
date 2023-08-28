<?php

namespace Dflydev\Canal\Detector;

use Dflydev\Canal\InternetMediaType\InternetMediaTypeInterface;
use Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface;
use Dflydev\Canal\Metadata\Metadata;
use PHPUnit\Framework\TestCase;

class CompositeDetectorTest extends TestCase
{
    public function testEmpty()
    {
        $internetMediaTypeParser = $this->getMockBuilder(InternetMediaTypeParserInterface::class)->getMock();
        $metadata = $this->getMockBuilder(Metadata::class)->getMock();

        $detector = new CompositeDetector;

        $this->assertNull($detector->detect($internetMediaTypeParser));
        $this->assertNull($detector->detect($internetMediaTypeParser, null, $metadata));
    }

    public function testAllFromConstructorWithNoMetadataFail()
    {
        $internetMediaTypeParser = $this->getMockBuilder(InternetMediaTypeParserInterface::class)->getMock();
        $internalDetector0 = $this->getMockBuilder(DetectorInterface::class)->getMock();
        $internalDetector1 = $this->getMockBuilder(DetectorInterface::class)->getMock();

        $internalDetector0
            ->expects($this->once())
            ->method('detect')
            ->with($internetMediaTypeParser, null, null)
            ->will($this->returnValue(null));

        $internalDetector1
            ->expects($this->once())
            ->method('detect')
            ->with($internetMediaTypeParser, null, null)
            ->will($this->returnValue(null));

        $detector = new CompositeDetector(array($internalDetector0, $internalDetector1));

        $this->assertNull($detector->detect($internetMediaTypeParser));
    }

    public function testAllFromConstructorWithMetadataFail()
    {
        $internetMediaTypeParser = $this->getMockBuilder(InternetMediaTypeParserInterface::class)->getMock();
        $metadata = $this->getMockBuilder(Metadata::class)->getMock();
        $internalDetector0 = $this->getMockBuilder(DetectorInterface::class)->getMock();
        $internalDetector1 = $this->getMockBuilder(DetectorInterface::class)->getMock();

        $internalDetector0
            ->expects($this->once())
            ->method('detect')
            ->with($internetMediaTypeParser, null, $metadata)
            ->will($this->returnValue(null));

        $internalDetector1
            ->expects($this->once())
            ->method('detect')
            ->with($internetMediaTypeParser, null, $metadata)
            ->will($this->returnValue(null));

        $detector = new CompositeDetector(array($internalDetector0, $internalDetector1));

        $this->assertNull($detector->detect($internetMediaTypeParser, null, $metadata));
    }

    public function testAllFromConstructorAndAddWithNoMetadataFail()
    {
        $internetMediaTypeParser = $this->getMockBuilder(InternetMediaTypeParserInterface::class)->getMock();
        $internalDetector0 = $this->getMockBuilder(DetectorInterface::class)->getMock();
        $internalDetector1 = $this->getMockBuilder(DetectorInterface::class)->getMock();

        $internalDetector0
            ->expects($this->once())
            ->method('detect')
            ->with($internetMediaTypeParser, null, null)
            ->will($this->returnValue(null));

        $internalDetector1
            ->expects($this->once())
            ->method('detect')
            ->with($internetMediaTypeParser, null, null)
            ->will($this->returnValue(null));

        $detector = new CompositeDetector(array($internalDetector0));

        $detector->addDetector($internalDetector1);

        $this->assertNull($detector->detect($internetMediaTypeParser));
    }

    public function testAllFromConstructorAndAddWithMetadataFail()
    {
        $internetMediaTypeParser = $this->getMockBuilder(InternetMediaTypeParserInterface::class)->getMock();
        $metadata = $this->getMockBuilder(Metadata::class)->getMock();
        $internalDetector0 = $this->getMockBuilder(DetectorInterface::class)->getMock();
        $internalDetector1 = $this->getMockBuilder(DetectorInterface::class)->getMock();

        $internalDetector0
            ->expects($this->once())
            ->method('detect')
            ->with($internetMediaTypeParser, null, $metadata)
            ->will($this->returnValue(null));

        $internalDetector1
            ->expects($this->once())
            ->method('detect')
            ->with($internetMediaTypeParser, null, $metadata)
            ->will($this->returnValue(null));

        $detector = new CompositeDetector(array($internalDetector0));

        $detector->addDetector($internalDetector1);

        $this->assertNull($detector->detect($internetMediaTypeParser, null, $metadata));
    }

    public function testFirstDetectorLocates()
    {
        $internetMediaTypeParser = $this->getMockBuilder(InternetMediaTypeParserInterface::class)->getMock();
        $metadata = $this->getMockBuilder(Metadata::class)->getMock();
        $internalDetector0 = $this->getMockBuilder(DetectorInterface::class)->getMock();
        $internalDetector1 = $this->getMockBuilder(DetectorInterface::class)->getMock();
        $expectedInternetMediaType = $this->getMockBuilder(InternetMediaTypeInterface::class)->getMock();

        $internalDetector0
            ->expects($this->once())
            ->method('detect')
            ->with($internetMediaTypeParser, null, $metadata)
            ->will($this->returnValue($expectedInternetMediaType));

        $internalDetector1
            ->expects($this->never())
            ->method('detect');

        $expectedInternetMediaType
            ->expects($this->once())
            ->method('asString')
            ->will($this->returnValue('text/css'));

        $detector = new CompositeDetector(array($internalDetector0, $internalDetector1));

        $detected = $detector->detect($internetMediaTypeParser, null, $metadata);

        $this->assertEquals('text/css', $detected->asString());
    }

    public function testLatterDetectorLocates()
    {
        $internetMediaTypeParser = $this->getMockBuilder(InternetMediaTypeParserInterface::class)->getMock();
        $metadata = $this->getMockBuilder(Metadata::class)->getMock();
        $internalDetector0 = $this->getMockBuilder(DetectorInterface::class)->getMock();
        $internalDetector1 = $this->getMockBuilder(DetectorInterface::class)->getMock();
        $expectedInternetMediaType = $this->getMockBuilder(InternetMediaTypeInterface::class)->getMock();

        $internalDetector0
            ->expects($this->once())
            ->method('detect')
            ->with($internetMediaTypeParser, null, $metadata)
            ->will($this->returnValue(null));

        $internalDetector1
            ->expects($this->once())
            ->method('detect')
            ->with($internetMediaTypeParser, null, $metadata)
            ->will($this->returnValue($expectedInternetMediaType));

        $expectedInternetMediaType
            ->expects($this->once())
            ->method('asString')
            ->will($this->returnValue('text/css'));

        $detector = new CompositeDetector(array($internalDetector0, $internalDetector1));

        $detected = $detector->detect($internetMediaTypeParser, null, $metadata);

        $this->assertEquals('text/css', $detected->asString());
    }
}
