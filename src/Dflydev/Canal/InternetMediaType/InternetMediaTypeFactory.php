<?php

namespace Dflydev\Canal\InternetMediaType;

use Dflydev\Canal\InternetMediaType\Adapter\Webignition\InternetMediaTypeParser;

class InternetMediaTypeFactory
{
    const TEXT_PLAIN = 'text/plain';
    const TEXT_HTML = 'text/html';
    const APPLICATION_OCTET_STREAM = 'application/octet-stream';
    const APPLICATION_XML = 'application/xml';
    const APPLICATION_ZIP = 'application/zip';

    private $textPlain;
    private $textHtml;
    private $applicationOctetStream;
    private $applicationXml;
    private $applicationZip;

    public function __construct(InternetMediaTypeParserInterface $internetMediaTypeParser = null)
    {
        if (null === $internetMediaTypeParser) {
            $this->internetMediaTypeParser = DefaultInternetMediaTypeParserFactory::create();
        } else {
            $this->internetMediaTypeParser = $internetMediaTypeParser;
        }
    }

    public function createTextPlain()
    {
        if (null === $this->textPlain) {
            $this->textPlain = $this->internetMediaTypeParser->parse(self::TEXT_PLAIN);
        }

        return $this->textPlain;
    }

    public function createTextHtml()
    {
        if (null === $this->textHtml) {
            $this->textHtml = $this->internetMediaTypeParser->parse(self::TEXT_HTML);
        }

        return $this->textHtml;
    }

    public function createApplicationOctetStream()
    {
        if (null === $this->applicationOctetStream) {
            $this->applicationOctetStream = $this->internetMediaTypeParser->parse(self::APPLICATION_OCTET_STREAM);
        }

        return $this->applicationOctetStream;
    }

    public function createApplicationXml()
    {
        if (null === $this->applicationXml) {
            $this->applicationXml = $this->internetMediaTypeParser->parse(self::APPLICATION_XML);
        }

        return $this->applicationXml;
    }

    public function createApplicationZip()
    {
        if (null === $this->applicationZip) {
            $this->applicationZip = $this->internetMediaTypeParser->parse(self::APPLICATION_ZIP);
        }

        return $this->applicationZip;
    }

    public function createApplication($type)
    {
        return $this->internetMediaTypeParser->parse('application/'.$type);
    }

    public function createAudio($type)
    {
        return $this->internetMediaTypeParser->parse('audio/'.$type);
    }

    public function createImage($type)
    {
        return $this->internetMediaTypeParser->parse('image/'.$type);
    }

    public function createText($type)
    {
        return $this->internetMediaTypeParser->parse('text/'.$type);
    }

    public function createVideo($type)
    {
        return $this->internetMediaTypeParser->parse('video/'.$type);
    }
}
