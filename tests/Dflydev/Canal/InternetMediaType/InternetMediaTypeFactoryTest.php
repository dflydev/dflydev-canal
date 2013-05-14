<?php

namespace Dflydev\Canal\InternetMediaType;

class InternetMediaTypeFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultConstructor()
    {
        new InternetMediaTypeFactory;
    }

    public function testConstructor()
    {
        $internetMediaTypeParser = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface');

        new InternetMediaTypeFactory($internetMediaTypeParser);
    }

    public function testCreateTextPlain()
    {
        $internetMediaType = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeInterface');
        $internetMediaType
            ->expects($this->once())
            ->method('asString')
            ->will($this->returnValue('text/plain'));

        $internetMediaTypeParser = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface');
        $internetMediaTypeParser
            ->expects($this->once())
            ->method('parse')
            ->with('text/plain')
            ->will($this->returnValue($internetMediaType));

        $factory = new InternetMediaTypeFactory($internetMediaTypeParser);
        $textPlain = $factory->createTextPlain();
        $this->assertEquals('text/plain', $textPlain->asString());
    }

    public function testCreateTextHtml()
    {
        $internetMediaType = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeInterface');
        $internetMediaType
            ->expects($this->once())
            ->method('asString')
            ->will($this->returnValue('text/html'));

        $internetMediaTypeParser = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface');
        $internetMediaTypeParser
            ->expects($this->once())
            ->method('parse')
            ->with('text/html')
            ->will($this->returnValue($internetMediaType));

        $factory = new InternetMediaTypeFactory($internetMediaTypeParser);
        $textHtml = $factory->createTextHtml();
        $this->assertEquals('text/html', $textHtml->asString());
    }

    public function testCreateApplicationOctetStream()
    {
        $internetMediaType = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeInterface');
        $internetMediaType
            ->expects($this->once())
            ->method('asString')
            ->will($this->returnValue('application/octet-stream'));

        $internetMediaTypeParser = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface');
        $internetMediaTypeParser
            ->expects($this->once())
            ->method('parse')
            ->with('application/octet-stream')
            ->will($this->returnValue($internetMediaType));

        $factory = new InternetMediaTypeFactory($internetMediaTypeParser);
        $applicationOctetStream = $factory->createApplicationOctetStream();
        $this->assertEquals('application/octet-stream', $applicationOctetStream->asString());
    }

    public function testCreateApplicationXml()
    {
        $internetMediaType = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeInterface');
        $internetMediaType
            ->expects($this->once())
            ->method('asString')
            ->will($this->returnValue('application/xml'));

        $internetMediaTypeParser = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface');
        $internetMediaTypeParser
            ->expects($this->once())
            ->method('parse')
            ->with('application/xml')
            ->will($this->returnValue($internetMediaType));

        $factory = new InternetMediaTypeFactory($internetMediaTypeParser);
        $applicationXml = $factory->createApplicationXml();
        $this->assertEquals('application/xml', $applicationXml->asString());
    }

    public function testCreateApplicationZip()
    {
        $internetMediaType = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeInterface');
        $internetMediaType
            ->expects($this->once())
            ->method('asString')
            ->will($this->returnValue('application/zip'));

        $internetMediaTypeParser = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface');
        $internetMediaTypeParser
            ->expects($this->once())
            ->method('parse')
            ->with('application/zip')
            ->will($this->returnValue($internetMediaType));

        $factory = new InternetMediaTypeFactory($internetMediaTypeParser);
        $applicationZip = $factory->createApplicationZip();
        $this->assertEquals('application/zip', $applicationZip->asString());
    }

    public function testCreateCustomApplication()
    {
        $internetMediaType = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeInterface');
        $internetMediaType
            ->expects($this->once())
            ->method('asString')
            ->will($this->returnValue('application/canal-custom'));

        $internetMediaTypeParser = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface');
        $internetMediaTypeParser
            ->expects($this->once())
            ->method('parse')
            ->with('application/canal-custom')
            ->will($this->returnValue($internetMediaType));

        $factory = new InternetMediaTypeFactory($internetMediaTypeParser);
        $custom = $factory->createApplication('canal-custom');
        $this->assertEquals('application/canal-custom', $custom->asString());
    }

    public function testCreateCustomAudio()
    {
        $internetMediaType = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeInterface');
        $internetMediaType
            ->expects($this->once())
            ->method('asString')
            ->will($this->returnValue('audio/canal-custom'));

        $internetMediaTypeParser = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface');
        $internetMediaTypeParser
            ->expects($this->once())
            ->method('parse')
            ->with('audio/canal-custom')
            ->will($this->returnValue($internetMediaType));

        $factory = new InternetMediaTypeFactory($internetMediaTypeParser);
        $custom = $factory->createAudio('canal-custom');
        $this->assertEquals('audio/canal-custom', $custom->asString());
    }

    public function testCreateCustomImage()
    {
        $internetMediaType = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeInterface');
        $internetMediaType
            ->expects($this->once())
            ->method('asString')
            ->will($this->returnValue('image/canal-custom'));

        $internetMediaTypeParser = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface');
        $internetMediaTypeParser
            ->expects($this->once())
            ->method('parse')
            ->with('image/canal-custom')
            ->will($this->returnValue($internetMediaType));

        $factory = new InternetMediaTypeFactory($internetMediaTypeParser);
        $custom = $factory->createImage('canal-custom');
        $this->assertEquals('image/canal-custom', $custom->asString());
    }

    public function testCreateCustomText()
    {
        $internetMediaType = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeInterface');
        $internetMediaType
            ->expects($this->once())
            ->method('asString')
            ->will($this->returnValue('text/canal-custom'));

        $internetMediaTypeParser = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface');
        $internetMediaTypeParser
            ->expects($this->once())
            ->method('parse')
            ->with('text/canal-custom')
            ->will($this->returnValue($internetMediaType));

        $factory = new InternetMediaTypeFactory($internetMediaTypeParser);
        $custom = $factory->createText('canal-custom');
        $this->assertEquals('text/canal-custom', $custom->asString());
    }

    public function testCreateCustomVideo()
    {
        $internetMediaType = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeInterface');
        $internetMediaType
            ->expects($this->once())
            ->method('asString')
            ->will($this->returnValue('video/canal-custom'));

        $internetMediaTypeParser = $this->getMock('Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface');
        $internetMediaTypeParser
            ->expects($this->once())
            ->method('parse')
            ->with('video/canal-custom')
            ->will($this->returnValue($internetMediaType));

        $factory = new InternetMediaTypeFactory($internetMediaTypeParser);
        $custom = $factory->createVideo('canal-custom');
        $this->assertEquals('video/canal-custom', $custom->asString());
    }
}
