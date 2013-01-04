<?php

namespace Dflydev\Canal\Detector;

use Dflydev\Canal\Metadata\Metadata;

class ApacheMimeTypesExtensionDetectorTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultRepositoryWithNoMetadata()
    {
        $internetMediaTypeParser = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface');
        $metadata = $this->getMock('Dflydev\Canal\Metadata\Metadata');

        $detector = new ApacheMimeTypesExtensionDetector;

        $this->assertNull($detector->detect($internetMediaTypeParser));
        $this->assertNull($detector->detect($internetMediaTypeParser, null, $metadata));
    }

    public function testDefaultRepositoryWithNonsenseMetadata()
    {
        $internetMediaTypeParser = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface');
        $metadata = $this->getMock('Dflydev\Canal\Metadata\Metadata');

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
        $internetMediaTypeParser = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface');
        $metadata = $this->getMock('Dflydev\Canal\Metadata\Metadata');
        $expectedInternetMediaType = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeInterface');

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
        $repository = $this->getMock('Dflydev\ApacheMimeTypes\RepositoryInterface');
        $internetMediaTypeParser = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface');
        $metadata = $this->getMock('Dflydev\Canal\Metadata\Metadata');
        $expectedInternetMediaType = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeInterface');

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
