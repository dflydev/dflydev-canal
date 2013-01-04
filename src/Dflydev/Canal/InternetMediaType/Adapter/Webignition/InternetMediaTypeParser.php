<?php

namespace Dflydev\Canal\InternetMediaType\Adapter\Webignition;

use Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface;
use webignition\InternetMediaType\Parser\Parser;

class InternetMediaTypeParser implements InternetMediaTypeParserInterface
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
        return new InternetMediaType($this->parser->parse($type));
    }
}
