<?php
namespace Rss\Src;

class RssReader implements \IteratorAggregate
{
    private $url;

    private $category;

    private $title;

    private $lastModDate;

    private $rssItems;

    public function __construct($url, $categoryName)
    {
        $this->url = $url;
        $this->category = $categoryName;
    }

    public function getRssItems()
    {
        return $this->rssItems;
    }

    public function setRssItems(\SplObjectStorage $rssItems)
    {
        $this->rssItems = $rssItems;
    }

    public function getIterator()
    {
        $storage = new \SplObjectStorage();
        $storage->addAll($this->rssItems);
        return $storage;
    }

    public function filterRssItemsBy(\FilterIterator $iterator)
    {
        $rssItems = new \SplObjectStorage();
        $iterator->rewind();
        while($iterator->valid()) {

            $rssItems->attach($iterator->current());

            $iterator->next();
        }
        $this->setRssItems($rssItems);
        return $iterator;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getLastModDate()
    {
        return $this->lastModDate;
    }

    public function setLastModDate($lastModDate)
    {
        $this->lastModDate = $lastModDate;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }
}