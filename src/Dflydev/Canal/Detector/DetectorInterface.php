<?php

namespace Dflydev\Canal\Detector;

use Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface;
use Dflydev\Canal\Metadata\Metadata;

interface DetectorInterface
{
    public function detect(InternetMediaTypeParserInterface $internetMediaTypeParser, $input = null, Metadata $metadata = null);
}
