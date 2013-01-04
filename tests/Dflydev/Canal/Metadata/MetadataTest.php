<?php

namespace Dflydev\Canal\Metadata;

class MetadataTest extends \PHPUnit_Framework_TestCase
{
    public function testSingle()
    {
        $metadata = new Metadata;
        $metadata->set('a', 'A');

        $this->assertCount(1, $a = $metadata->getList('a'));
        $this->assertEquals('A', $a[0]);
        $this->assertEquals('A', $metadata->get('a'));

        $this->assertCount(0, $metadata->getList('b'));
        $this->assertNull($metadata->get('b'));
    }

    public function testMultiple()
    {
        $metadata = new Metadata;
        $metadata->set('a', array('A'));
        $metadata->set('b', array('B', 'BB', 'BBB'));

        $this->assertCount(1, $metadata->getList('a'));
        $this->assertEquals('A', $metadata->get('a'));

        $this->assertCount(3, $b = $metadata->getList('b'));
        $this->assertEquals(array('B', 'BB', 'BBB'), $b);
        $this->assertEquals('B', $metadata->get('b'));
    }
}
