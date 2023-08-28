<?php

namespace Dflydev\Canal\Detector;

use Dflydev\Canal\InternetMediaType\InternetMediaTypeInterface;
use Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface;
use Dflydev\Canal\Metadata\Metadata;
use PHPUnit\Framework\TestCase;

class ApacheMimeTypesExtensionDetectorTest extends TestCase
{
    public function testDefaultRepositoryWithNoMetadata()
    {
        $internetMediaTypeParser = $this->getMockBuilder(InternetMediaTypeParserInterface::class)->getMock();
        $metadata = $this->getMockBuilder(Metadata::class)->getMock();

        $detector = new ApacheMimeTypesExtensionDetector;

        $this->assertNull($detector->detect($internetMediaTypeParser));
        $this->assertNull($detector->detect($internetMediaTypeParser, null, $metadata));
    }

    public function testDefaultRepositoryWithNonsenseMetadata()
    {
        $internetMediaTypeParser = $this->getMockBuilder(InternetMediaTypeParserInterface::class)->getMock();
        $metadata = $this->getMockBuilder(Metadata::class)->getMock();

        $metadata
            ->expects($this->once())
            ->method('get')
            ->with(Metadata::RESOURCE_NAME_KEY)
            ->will($this->returnValue('/path/to/some/file.some-extension-clearly-does-not-exist'));

        $detector = new ApacheMimeTypesExtensionDetector;

        $this->assertNull($detector->detect($internetMediaTypeParser));
        $this->assertNull($detector->detect($internetMediaTypeParser, null, $metadata));
    }

    public function testDefaultRepositoryWithMetadata()
    {
        $internetMediaTypeParser = $this->getMockBuilder(InternetMediaTypeParserInterface::class)->getMock();
        $metadata = $this->getMockBuilder(Metadata::class)->getMock();
        $expectedInternetMediaType = $this->getMockBuilder(InternetMediaTypeInterface::class)->getMock();

        $metadata
            ->expects($this->once())
            ->method('get')
            ->with(Metadata::RESOURCE_NAME_KEY)
            ->will($this->returnValue('/path/to/some/file.css'));

        $internetMediaTypeParser
            ->expects($this->once())
            ->method('parse')
            ->with('text/css')
            ->will($this->returnValue($expectedInternetMediaType));

        $expectedInternetMediaType
            ->expects($this->once())
            ->method('asString')
            ->will($this->returnValue('text/css'));

        $detector = new ApacheMimeTypesExtensionDetector;

        $detected = $detector->detect($internetMediaTypeParser, null, $metadata);

        $this->assertEquals('text/css', $detected->asString());
    }

    public function testCustomRepositoryWithMetadata()
    {
        $repository = $this->getMockBuilder('Dflydev\ApacheMimeTypes\RepositoryInterface')->getMock();
        $internetMediaTypeParser = $this->getMockBuilder(InternetMediaTypeParserInterface::class)->getMock();
        $metadata = $this->getMockBuilder(Metadata::class)->getMock();
        $expectedInternetMediaType = $this->getMockBuilder(InternetMediaTypeInterface::class)->getMock();

        $repository
            ->expects($this->once())
            ->method('findType')
            ->with('css')
            ->will($this->returnValue('text/css'));

        $metadata
            ->expects($this->once())
            ->method('get')
            ->with(Metadata::RESOURCE_NAME_KEY)
            ->will($this->returnValue('/path/to/some/file.css'));

        $internetMediaTypeParser
            ->expects($this->once())
            ->method('parse')
            ->with('text/css')
            ->will($this->returnValue($expectedInternetMediaType));

        $expectedInternetMediaType
            ->expects($this->once())
            ->method('asString')
            ->will($this->returnValue('text/css'));

        $detector = new ApacheMimeTypesExtensionDetector($repository);

        $detected = $detector->detect($internetMediaTypeParser, null, $metadata);

        $this->assertEquals('text/css', $detected->asString());
    }
}
