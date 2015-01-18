<?php

namespace Rss\Lib;

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

        $feeds = array();
        foreach ($document->getElementsByTagName('item') as $node) {
            $item = array(
                'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
                'description' => $node->getElementsByTagName('description')->item(0)->nodeValue,
                'pubDate' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
                'guid' => $node->getElementsByTagName('guid')->item(0)->nodeValue,
                'link' => $node->getElementsByTagName('link')->item(0)->nodeValue
            );
            array_push($feeds, $item);
        }
        $this->setFeeds($feeds);
    }
}