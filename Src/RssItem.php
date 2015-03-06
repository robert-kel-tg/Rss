<?php
namespace Rss\Src;

class RssItem
{
    private $title;

    private $description;

    private $pubDate;

    private $guid;

    private $link;

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getPubDate()
    {
        return $this->pubDate->format('Y-m-d');
    }

    public function setPubDate($pubDate)
    {
        $this->pubDate = new \DateTime($pubDate);
    }

    public function getGuid()
    {
        return $this->guid;
    }

    public function setGuid($guid)
    {
        $this->guid = $guid;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setLink($link)
    {
        $this->link = $link;
    }
}