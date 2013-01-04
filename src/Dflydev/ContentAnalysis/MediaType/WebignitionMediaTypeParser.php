<?php

namespace Dflydev\ContentAnalysis\MediaType;

use webignition\InternetMediaType\Parser\Parser;

class WebignitionMediaTypeParser implements MediaTypeParserInterface
{
    private $parser;

    public function __construct(Parser $parser = null)
    {
        if (null === $parser) {
            $parser = new Parser;
        }

        $this->parser = $parser;
    }

    public function parse($type)
    {
        return $this->parser->parse($type);
    }
}
