<?php
namespace Rss\Lib;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Rss\Entity\Feed;
use Rss\Entity\Item;

class RssDb
{

    private $feeds = array();

    private $url;

    private $category;

    private $title;

    private $lastModDate;

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
     * @return array
     */
    public function getFeeds()
    {
        return $this->feeds;
    }

    /**
     * @param array $feeds
     */
    public function setFeeds($feeds)
    {
        $this->feeds = $feeds;
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

    public function init()
    {
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

        try {

            $entityManager->getConnection()->beginTransaction();

                $feed = new Feed();
                $feed->setUrl($this->url);
                $feed->setTitle($this->title);
                $feed->setLast_update(new \DateTime($this->lastModDate));
                $feed->setCategory($this->category);

                $entityManager->persist($feed);
                $entityManager->flush();

                $this->feeds->rewind();
                    while($this->feeds->valid()) {

                        $item = new Item();
                        $item->setFeed_id($feed->getId());
                        $item->setTitle($this->feeds->current()->getTitle());
                        $item->setLink($this->feeds->current()->getLink());
                        $item->setDescription($this->feeds->current()->getDescription());
                        $item->setPublished(new \DateTime($this->feeds->current()->getPubDate()));

                        $this->feeds->next();

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