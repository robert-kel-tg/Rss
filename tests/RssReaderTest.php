<?php
namespace Rss\Tests;

use Rss\Src\RssReader;

class RssReaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function checkIfValidArguments()
    {
        $reader = new RssReader('test-url', 'test-category-name');
        $this->assertEquals('test-url', $reader->getUrl());
        $this->assertEquals('test-category-name', $reader->getCategory());
    }
}