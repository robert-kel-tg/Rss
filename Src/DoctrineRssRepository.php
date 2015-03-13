<?php

namespace Rss\Src;


class DoctrineRssRepository implements RssRepositoryInterface
{
    private $entityManager;

    public function __construct(RssEntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findFeedByName($name)
    {
        $feedRepository = $this->entityManager->getRepository('Rss\Entity\Feed');

        return $feedRepository->findOneBy(array('category'=>$name));;
    }

    public function getItemsByFeedId($feedId)
    {
        $itemRepository = $this->entityManager->getRepository('Rss\Entity\Item');
        return $itemRepository->findBy(array('feed_id' => $feedId));
    }
}