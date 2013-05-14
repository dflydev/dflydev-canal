<?php

namespace Dflydev\Canal\InternetMediaType;

interface InternetMediaTypeInterface
{
    public function getType();
    public function getSubtype();
    public function getParameter($parameter);
    public function getParameters();
    public function asString();
    public function equals(InternetMediaTypeInterface $that);
}
