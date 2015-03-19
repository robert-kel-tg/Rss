<?php

namespace Rss\Tests;


use App\Entity\Item;
use Zend\XmlRpc\Value\DateTime;

class RssServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function checkIfRssItemsCorrect()
    {
//        $doctrineRssRepository = $this->mock('\Rss\Src\RssRepositoryInterface');
//        $doctrineRssRepository->expects($this->once())->method('getScore')->will($this->returnValue(100));

        $item = new Item();
        $item->setId(5);
        $item->setFeed_id(2);
        $item->setTitle('item-title');
        $item->setLink('item-link');
        $item->setDescription('item-description');
        $item->setPublished(new DateTime('2015-01-01'));

        $doctrineRssRepository = $this->getMockBuilder('\Rss\Src\RssRepositoryInterface')
            ->setMethods(array('findFeedByName'))
            ->getMock();

        $doctrineRssRepository->expects($this->once())
            ->method('findFeedByName')
            ->with($this->equalTo('Petras'))
            ->will($this->returnValue($item));

        //echo '<pre>';
        //die(print_r($doctrineRssRepository));
        //echo '</pre>';
    }

//    protected function getEmMock()
//    {
//        $emMock  = $this->getMock('\Doctrine\ORM\EntityManager',
//            array('getRepository', 'getClassMetadata', 'persist', 'flush'), array(), '', false);
//        $emMock->expects($this->any())
//            ->method('getRepository')
//            ->will($this->returnValue(new FakeRepository()));
//        $emMock->expects($this->any())
//            ->method('getClassMetadata')
//            ->will($this->returnValue((object)array('name' => 'aClass')));
//        $emMock->expects($this->any())
//            ->method('persist')
//            ->will($this->returnValue(null));
//        $emMock->expects($this->any())
//            ->method('flush')
//            ->will($this->returnValue(null));
//        return $emMock;  // it tooks 13 lines to achieve mock!
//    }
}
