<?php

namespace Rss\Lib;

class RssItem
{
    private $title;

    private $description;

    private $pubDate;

    private $guid;

    private $link;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPubDate()
    {
        return $this->pubDate;
    }

    /**
     * @param mixed $pubDate
     */
    public function setPubDate($pubDate)
    {
        $this->pubDate = $pubDate;
    }

    /**
     * @return mixed
     */
    public function getGuid()
    {
        return $this->guid;
    }

    /**
     * @param mixed $guid
     */
    public function setGuid($guid)
    {
        $this->guid = $guid;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

}

class RssReader
{
    private $url;

    private $category;

    private $title;

    private $lastModDate;

    private $feeds;

    /**
     * @return mixed
     */
    public function getFeeds()
    {
        return $this->feeds;
    }

    /**
     * @param mixed $feeds
     */
    public function setFeeds($feeds)
    {
        $this->feeds = $feeds;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getLastModDate()
    {
        return $this->lastModDate;
    }

    /**
     * @param mixed $lastModDate
     */
    public function setLastModDate($lastModDate)
    {
        $this->lastModDate = $lastModDate;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function grabRssFromUrl(\DOMDocument $document)
    {
        $document->load($this->url);

        $root_el_nodes = $document->getElementsByTagName('channel')->item(0)->childNodes;

        $title = $root_el_nodes->item(1)->nodeValue;
        $lastModDate= $root_el_nodes->item(9)->nodeValue;

        $this->setTitle($title);
        $this->setLastModDate($lastModDate);

        $spl = new \SplObjectStorage();
        foreach ($document->getElementsByTagName('item') as $node) {

            $rssitem = new RssItem();
            $rssitem->setTitle($node->getElementsByTagName('title')->item(0)->nodeValue);
            $rssitem->setDescription($node->getElementsByTagName('description')->item(0)->nodeValue);
            $rssitem->setPubDate($node->getElementsByTagName('pubDate')->item(0)->nodeValue);
            $rssitem->setGuid($node->getElementsByTagName('guid')->item(0)->nodeValue);
            $rssitem->setLink($node->getElementsByTagName('link')->item(0)->nodeValue);

            $spl->attach($rssitem);
            $rss = null;
        }
        $this->setFeeds($spl);
    }
}