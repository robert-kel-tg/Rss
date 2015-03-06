<?php
namespace Rss\Src;

class Config
{
    private $driver;

    private $user;

    private $password;

    private $dbname;

    private $isDevMode;

    public function __construct()
    {
        $this->driver = 'pdo_mysql';
        $this->user = 'root';
        $this->password = 'fikusas14';
        $this->dbname = 'feeds';
        $this->isDevMode = false;
    }

    public function getDriver()
    {
        return $this->driver;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getDbname()
    {
        return $this->dbname;
    }

    public function isIsDevMode()
    {
        return $this->isDevMode;
    }

    public function getParams()
    {
        return array(
            'driver' => $this->driver,
            'user' => $this->user,
            'password' => $this->password,
            'dbname' => $this->dbname
            );
    }
}