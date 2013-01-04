<?php

namespace Dflydev\ContentAnalysis\Detector;

class DefaultDetectorFactory
{
    public static function create()
    {
        return new ApacheMimeTypesExtensionDetector;
    }
}
