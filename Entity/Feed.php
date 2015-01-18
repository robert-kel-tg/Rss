<?php

namespace Rss\Entity;
// Entity/Feed.php
/**
 * @Entity @Table(name="feeds")
 **/
class Feed
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    private $id;

    /** @Column(type="string") **/
    private $url;

    /** @Column(type="string") **/
    private $title;

    /** @Column(type="datetime", name="last_update") */
    private $last_update;

    /** @Column(type="string") **/
    private $category;

    function __construct($id = null, $url = null, $title = null, $last_update = null, $category = null)
    {
        $this->id = $id;
        $this->url = $url;
        $this->title = $title;
        $this->last_update = $last_update;
        $this->category = $category;
    }

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
        return $this;
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
        return $this;
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
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLast_update()
    {
        return $this->last_update;
    }

    /**
     * @param mixed $last_update
     */
    public function setLast_update($last_update)
    {
        $this->last_update = $last_update;
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
        return $this;
    }

}