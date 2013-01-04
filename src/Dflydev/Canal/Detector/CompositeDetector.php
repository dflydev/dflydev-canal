<?php

namespace Dflydev\Canal\Detector;

use Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface;
use Dflydev\Canal\Metadata\Metadata;

class CompositeDetector implements DetectorInterface
{
    private $detectors;

    public function __construct(array $detectors = null)
    {
        if (null === $detectors) {
            $detectors = array();
        }

        $this->detectors = $detectors;
    }

    public function addDetector(DetectorInterface $detector)
    {
        $this->detectors[] = $detector;
    }

    public function detect(InternetMediaTypeParserInterface $internetMediaTypeParser, $input = null, Metadata $metadata = null)
    {
        foreach ($this->detectors as $detector) {
            $type = $detector->detect($internetMediaTypeParser, $input, $metadata);

            if (null !== $type) {
                return $type;
            }
        }

        return null;
    }
}
