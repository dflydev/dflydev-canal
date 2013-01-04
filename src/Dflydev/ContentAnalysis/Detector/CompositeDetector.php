<?php

namespace Dflydev\ContentAnalysis\Detector;

use Dflydev\ContentAnalysis\MediaType\MediaTypeParserInterface;
use Dflydev\ContentAnalysis\Metadata\Metadata;

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

    public function detect(MediaTypeParserInterface $mediaTypeParser, $input = null, Metadata $metadata = null)
    {
        foreach ($this->detectors as $detector) {
            $type = $detector->detect($mediaTypeParser, $input, $metadata);

            if (null !== $type) {
                return $type;
            }
        }

        return null;
    }
}
