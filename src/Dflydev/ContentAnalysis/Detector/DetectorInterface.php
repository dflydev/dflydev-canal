<?php

namespace Dflydev\ContentAnalysis\Detector;

use Dflydev\ContentAnalysis\MediaType\MediaTypeParserInterface;
use Dflydev\ContentAnalysis\Metadata\Metadata;

interface DetectorInterface
{
    public function detect(MediaTypeParserInterface $mediaTypeParser, $input = null, Metadata $metadata = null);
}
