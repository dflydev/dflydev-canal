<?php

namespace Dflydev\ContentAnalysis\Analyzer;

use Dflydev\ContentAnalysis\Detector\DefaultDetectorFactory;
use Dflydev\ContentAnalysis\Detector\DetectorInterface;
use Dflydev\ContentAnalysis\MediaType\DefaultMediaTypeParserFactory;
use Dflydev\ContentAnalysis\MediaType\MediaTypeParserInterface;
use Dflydev\ContentAnalysis\Metadata\Metadata;

class Analyzer
{
    private $detector;
    private $mediaTypeParser;

    public function __construct(DetectorInterface $detector = null)
    {
        if (null === $detector) {
            $detector = DefaultDetectorFactory::create();
        }

        $this->detector = $detector;
        $this->mediaTypeParser = DefaultMediaTypeParserFactory::create();
    }

    public function setDetector(DetectorInterface $detector)
    {
        $this->detector = $detector;

        return $this;
    }

    public function setMediaTypeParser(MediaTypeParserInterface $mediaTypeParser)
    {
        $this->mediaTypeParser = $mediaTypeParser;

        return $this;
    }

    public function detectFromFilename($filename)
    {
        $metadata = new Metadata;
        $metadata->set(Metadata::RESOURCE_NAME_KEY, $filename);

        return $this->detector->detect($this->mediaTypeParser, null, $metadata);
    }
}
