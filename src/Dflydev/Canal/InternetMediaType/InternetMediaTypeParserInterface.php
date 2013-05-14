<?php

namespace Dflydev\Canal\InternetMediaType;

interface InternetMediaTypeParserInterface
{
    public function parse($type);
    public function getFactory();
}
