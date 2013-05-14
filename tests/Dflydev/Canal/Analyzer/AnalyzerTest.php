<?php

namespace Dflydev\Canal\Analyzer;

use Dflydev\Canal\Metadata\Metadata;

class AnalyzerTest extends \PHPUnit_Framework_TestCase
{
    public function testKnownType()
    {
        $analyzer = new Analyzer;
        $internetMediaType = $analyzer->detectFromFilename('/path/to/some-file.html');

        $this->assertEquals('text/html', $internetMediaType->asString());
    }

    public function testFallback()
    {
        $analyzer = new Analyzer;
        $internetMediaType = $analyzer->detectFromFilename('/path/to/some-file.canal-extension-foo');

        $this->assertEquals('application/octet-stream', $internetMediaType->asString());
    }
}
