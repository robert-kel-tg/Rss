<?php
require_once "vendor/autoload.php";

use Rss\Src\RssService;
use Rss\Src\RssReader;
use Rss\Src\RssEntityManager;
use Rss\Src\Config;
use Rss\Src\RssItemsPublishedFromFilterIterator;
use Rss\Src\RssItemsPublishedToFilterIterator;

$rss_service = new RssService(new RssReader('http://www.nfq.lt/rss', 'Kategorija10'));
$rss_service->read();
$iterator = $rss_service->getRssReaderIterator();
$iterator = $rss_service->filterRssItemsBy(new RssItemsPublishedFromFilterIterator(new \DateTime('2014-10-01'), $iterator));
//$iterator = $rss_service->filterRssItemsBy(new RssItemsPublishedToFilterIterator(new \DateTime('2011-01-01'), $iterator));

echo '<pre>';
die(print_r($rss_service));
echo '</pre>';
$rss_service->persist(new RssEntityManager(new Config()));

echo '<pre>';
die(print_r($rss_service));
echo '</pre>';