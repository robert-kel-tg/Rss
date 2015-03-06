<?php
namespace Rss\Src;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class RssEntityManager
{
    private $entityManager;

    private $location = array('Entity');

    public function __construct(Config $config, $isDevMode = false)
    {
        $this->entityManager = EntityManager::create($config->getParams(),
            Setup::createAnnotationMetadataConfiguration($this->location, $config->isIsDevMode()));

        $this->getEntityManager();
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function getRepository($repository)
    {
        return $this->getEntityManager()->getRepository($repository);
    }
}