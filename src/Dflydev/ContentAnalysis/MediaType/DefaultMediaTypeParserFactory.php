<?php

namespace Dflydev\ContentAnalysis\MediaType;

class DefaultMediaTypeParserFactory
{
    public static function create()
    {
        return new WebignitionMediaTypeParser;
    }
}
