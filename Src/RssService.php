<?php

namespace Rss\Src;

use Rss\Entity\Item;
use Rss\Entity\Feed;

class RssService
{
    private $rssReader;

    public function __construct(RssReader $rssReader)
    {
        $this->rssReader = $rssReader;
    }

//    public function read(RssDomDocumentIterator $rssDomDocumentIterator)
//    {
//        $items = $rssDomDocumentIterator->read();
//        $this->rssReader->setRssItems($items);
//    }
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
        $this->rssReader->setRssItems($spl);
    }

    public function getRssReaderIterator()
    {
        return $this->rssReader->getIterator();
    }

    public function filterRssItemsBy(\FilterIterator $iterator)
    {
        return $this->rssReader->filterRssItemsBy($iterator);
    }

    private function createFeed()
    {
        $feed = new Feed();
        $feed->setUrl($this->rssReader->getUrl());
        $feed->setTitle($this->rssReader->getTitle());
        $feed->setLast_update(new \DateTime($this->rssReader->getLastModDate()));
        $feed->setCategory($this->rssReader->getCategory());

        return $feed;
    }

    private function createItem(Feed $feed, RssItem $rssItem)
    {
        $item = new Item();
        $item->setFeed_id($feed->getId());
        $item->setTitle($rssItem->getTitle());
        $item->setLink($rssItem->getLink());
        $item->setDescription($rssItem->getDescription());
        $item->setPublished(new \DateTime($rssItem->getPubDate()));

        return $item;
    }

    public function persist(RssEntityManager $rssEntityManager)
    {
        try {
            $entityManager = $rssEntityManager->getEntityManager();

            $entityManager->getConnection()->beginTransaction();

                $feed = $this->createFeed();

            $entityManager->persist($feed);
            $entityManager->flush();

            $this->rssReader->getRssItems()->rewind();
            while($this->rssReader->getRssItems()->valid()) {

                    $item = $this->createItem($feed, $this->rssReader->getRssItems()->current());

                    $this->rssReader->getRssItems()->next();

                $entityManager->persist($item);
            }

            $entityManager->flush();

            $entityManager->getConnection()->commit();

        } catch (\Exception $e) {

            $entityManager->getConnection()->rollback();
            $entityManager->close();

            throw $e;
        }

    }
}