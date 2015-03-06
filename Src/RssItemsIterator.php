<?php
namespace Rss\Src;

class RssItemsIterator implements \Iterator
{
    private $storage;

    public function __construct(\SplObjectStorage $storage)
    {
        $this->storage = $storage;
    }

    public function current()
    {
        // TODO: Implement current() method.
    }

    public function next()
    {
        // TODO: Implement next() method.
    }

    public function key()
    {
        // TODO: Implement key() method.
    }

    public function valid()
    {
        // TODO: Implement valid() method.
    }

    public function rewind()
    {
        // TODO: Implement rewind() method.
    }
}