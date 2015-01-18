<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array("Entity");
$isDevMode = false;
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => 'password',
    'dbname'   => 'feeds',
);
$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);
$feedRepository = $entityManager->getRepository('Rss\Entity\Feed');

$dbfeed = $feedRepository->findOneBy(array('category'=>$category));

$loader = new Twig_Loader_Filesystem('Templates');
$twig = new Twig_Environment($loader);

if($dbfeed) {
    $itemRepository = $entityManager->getRepository('Rss\Entity\Item');
    $itemscount = $itemRepository->findBy(array('feed_id' => $dbfeed->getId()));
    $recentitem = $itemRepository->findOneBy(array(), array('id' => 'ASC'), 1, 0);

    echo $twig->render('app.html', array('feed' => $dbfeed, 'feeds_count' => count($itemscount), 'recent_item' => $recentitem));
} else {
    echo $twig->render('empty.html', array('empty_text' => 'In order to see something, import rss (f.g http://www.nfq.lt/rss) to DB via: php console.php grab:rss.'));
}
