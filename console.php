<?php

require_once('vendor/autoload.php');

use Rss\Src\RssCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new RssCommand());
$application->run();