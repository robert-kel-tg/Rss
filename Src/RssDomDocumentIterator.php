<?php
namespace Rss\Src;

class RssDomDocumentIterator extends \DOMDocument
{
    private $rssReader;

    public function __construct(RssReader $rssReader)
    {
        $this->rssReader = $rssReader;
    }

    public function read()
    {
        $document = new \DOMDocument();
        $document->load($this->rssReader->getUrl());

        $root_el_nodes = $document->getElementsByTagName('channel')->item(0)->childNodes;

        $title = $root_el_nodes->item(1)->nodeValue;
        $lastModDate= $root_el_nodes->item(9)->nodeValue;

        $this->rssReader->setTitle($title);
        $this->rssReader->setLastModDate($lastModDate);

        $spl = new \SplObjectStorage();
        foreach ($document->getElementsByTagName('item') as $node) {

            $rssItem = new RssItem();
            $rssItem->setTitle($node->getElementsByTagName('title')->item(0)->nodeValue);
            $rssItem->setDescription($node->getElementsByTagName('description')->item(0)->nodeValue);
            $rssItem->setPubDate($node->getElementsByTagName('pubDate')->item(0)->nodeValue);
            $rssItem->setGuid($node->getElementsByTagName('guid')->item(0)->nodeValue);
            $rssItem->setLink($node->getElementsByTagName('link')->item(0)->nodeValue);

            $spl->attach($rssItem);
            $rss = null;
        }
    }
}