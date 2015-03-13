<?php

//require_once "vendor/autoload.php";

use Rss\Src\RssEntityManager;
use Rss\Src\Config;
use Rss\Src\Twig;
use Rss\Src\DoctrineRssRepository;
use Rss\Entity\Feed;

$twig = new Twig(
    new Twig_Loader_Filesystem('Templates'),
    new Twig_Environment()
);

$doctrineRssRepository = new DoctrineRssRepository(new RssEntityManager(new Config()));
$dbFeed = $doctrineRssRepository->findFeedByName($category);

if ($dbFeed instanceof Feed) {
    $items = $doctrineRssRepository->getItemsByFeedId($dbFeed->getId());

    $iterator = new ArrayIterator($items);
    $countAll = $iterator->count();
    $iterator = new LimitIterator($iterator, 0, 1);

    $iterator->rewind();

    echo $twig->render('app.html',
        array('feed' => $dbFeed, 'feeds_count' => $countAll, 'recent_item' => $iterator->current()));
} else {
    echo $twig->render('empty.html',
        array('empty_text' => 'In order to see something, import rss (f.g http://www.nfq.lt/rss) to DB via: php console.php grab:rss.'));
}
