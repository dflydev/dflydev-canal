<?php

namespace Dflydev\Canal\Analyzer;

use Dflydev\Canal\Detector\DefaultDetectorFactory;
use Dflydev\Canal\Detector\DetectorInterface;
use Dflydev\Canal\InternetMediaType\DefaultInternetMediaTypeParserFactory;
use Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface;
use Dflydev\Canal\Metadata\Metadata;

class Analyzer
{
    private $detector;
    private $internetMediaTypeParser;

    public function __construct(DetectorInterface $detector = null)
    {
        if (null === $detector) {
            $detector = DefaultDetectorFactory::create();
        }

        $this->detector = $detector;
        $this->internetMediaTypeParser = DefaultInternetMediaTypeParserFactory::create();
    }

    public function setDetector(DetectorInterface $detector)
    {
        $this->detector = $detector;

        return $this;
    }

    public function setInternetMediaTypeParser(InternetMediaTypeParserInterface $internetMediaTypeParser)
    {
        $this->internetMediaTypeParser = $internetMediaTypeParser;

        return $this;
    }

    public function getInternetMediaTypeParser()
    {
        return $this->internetMediaTypeParser;
    }

    public function getInternetMediaTypeFactory()
    {
        return $this->internetMediaTypeParser->getFactory();
    }

    public function detect($input = null, Metadata $metadata = null)
    {
        return $this->normalizeInternetMediaType(
            $this->detector->detect($this->internetMediaTypeParser, $input, $metadata)
        );
    }

    public function detectFromFilename($filename)
    {
        $metadata = new Metadata;
        $metadata->set(Metadata::RESOURCE_NAME_KEY, $filename);

        return $this->normalizeInternetMediaType(
            $this->detector->detect($this->internetMediaTypeParser, null, $metadata)
        );
    }

    protected function normalizeInternetMediaType($internetMediaType = null)
    {
        if ($internetMediaType) {
            return $internetMediaType;
        }

        return $this->internetMediaTypeParser->getFactory()->createApplicationOctetStream();
    }
}
