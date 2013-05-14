<?php

namespace Dflydev\Canal\InternetMediaType\Adapter\Webignition;

use Dflydev\Canal\InternetMediaType\InternetMediaTypeInterface;
use webignition\InternetMediaType\InternetMediaType as WebignitionInternetMediaType;

class InternetMediaType implements InternetMediaTypeInterface
{
    public function __construct(WebignitionInternetMediaType $internetMediaType)
    {
        $this->internetMediaType = $internetMediaType;
    }

    public function getType()
    {
        return $this->internetMediaType->getType();
    }

    public function getSubtype()
    {
        return $this->internetMediaType->getSubtype();
    }

    public function getParameter($parameter)
    {
        return $this->internetMediaType->getParameter($parameter);
    }

    public function getParameters()
    {
        return $this->internetMediaType->getParameters();
    }

    public function asString()
    {
        return (string) $this->internetMediaType;
    }

    public function equals(InternetMediaTypeInterface $that = null)
    {
        if (null === $that) {
            return false;
        }

        return $this->asString() === $that->asString();
    }
}
