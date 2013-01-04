<?php

namespace Dflydev\Canal\Detector;

class DefaultDetectorFactory
{
    public static function create()
    {
        return new ApacheMimeTypesExtensionDetector;
    }
}
