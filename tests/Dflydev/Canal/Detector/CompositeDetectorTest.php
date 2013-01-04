<?php

namespace Dflydev\Canal\Detector;

class CompositeDetectorTest extends \PHPUnit_Framework_TestCase
{
    public function testEmpty()
    {
        $internetMediaTypeParser = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface');
        $metadata = $this->getMock('Dflydev\Canal\Metadata\Metadata');

        $detector = new CompositeDetector;

        $this->assertNull($detector->detect($internetMediaTypeParser));
        $this->assertNull($detector->detect($internetMediaTypeParser, null, $metadata));
    }

    public function testAllFromConstructorWithNoMetadataFail()
    {
        $internetMediaTypeParser = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface');
        $internalDetector0 = $this->getMock('Dflydev\Canal\Detector\DetectorInterface');
        $internalDetector1 = $this->getMock('Dflydev\Canal\Detector\DetectorInterface');

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
        $internetMediaTypeParser = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface');
        $metadata = $this->getMock('Dflydev\Canal\Metadata\Metadata');
        $internalDetector0 = $this->getMock('Dflydev\Canal\Detector\DetectorInterface');
        $internalDetector1 = $this->getMock('Dflydev\Canal\Detector\DetectorInterface');

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
        $internetMediaTypeParser = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface');
        $internalDetector0 = $this->getMock('Dflydev\Canal\Detector\DetectorInterface');
        $internalDetector1 = $this->getMock('Dflydev\Canal\Detector\DetectorInterface');

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
        $internetMediaTypeParser = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface');
        $metadata = $this->getMock('Dflydev\Canal\Metadata\Metadata');
        $internalDetector0 = $this->getMock('Dflydev\Canal\Detector\DetectorInterface');
        $internalDetector1 = $this->getMock('Dflydev\Canal\Detector\DetectorInterface');

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
        $internetMediaTypeParser = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface');
        $metadata = $this->getMock('Dflydev\Canal\Metadata\Metadata');
        $internalDetector0 = $this->getMock('Dflydev\Canal\Detector\DetectorInterface');
        $internalDetector1 = $this->getMock('Dflydev\Canal\Detector\DetectorInterface');
        $expectedInternetMediaType = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeInterface');

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
        $internetMediaTypeParser = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface');
        $metadata = $this->getMock('Dflydev\Canal\Metadata\Metadata');
        $internalDetector0 = $this->getMock('Dflydev\Canal\Detector\DetectorInterface');
        $internalDetector1 = $this->getMock('Dflydev\Canal\Detector\DetectorInterface');
        $expectedInternetMediaType = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeInterface');

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
