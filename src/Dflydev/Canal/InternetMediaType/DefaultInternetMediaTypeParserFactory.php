<?php

namespace Dflydev\Canal\InternetMediaType;

use Dflydev\Canal\InternetMediaType\Adapter\Webignition\InternetMediaTypeParser;

class DefaultInternetMediaTypeParserFactory
{
    public static function create()
    {
        return new InternetMediaTypeParser;
    }
}
