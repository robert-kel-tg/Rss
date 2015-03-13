<?php

namespace Rss\Src;


interface RssRepositoryInterface
{
    public function findFeedByName($name);

    public function getItemsByFeedId($feedId);
}