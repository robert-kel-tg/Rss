<?php

namespace Rss\Entity;

/**
 * @Entity @Table(name="items")
 **/
class Item
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    private $id;

    /** @Column(type="integer") **/
    private $feed_id;

    /** @Column(type="string") **/
    private $title;

    /** @Column(type="string") **/
    private $link;

    /** @Column(type="string") **/
    private $description;

    /** @Column(type="datetime", name="published") */
    private $published;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFeedId()
    {
        return $this->feed_id;
    }

    /**
     * @param mixed $feed_id
     */
    public function setFeed_id($feed_id)
    {
        $this->feed_id = $feed_id;
    }

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
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * @param mixed $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }
}