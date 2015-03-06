<?php
namespace Rss\Src;

class RssItemsPublishedFromFilterIterator extends \FilterIterator
{
    private $publishedFrom;

    public function __construct(\DateTime $publishedFrom, $iterator)
    {
        parent::__construct($iterator);

        $this->publishedFrom = $publishedFrom;
    }

    public function accept()
    {
        return $this->current()->getPubDate() >= $this->publishedFrom->format('Y-m-d');
    }
}