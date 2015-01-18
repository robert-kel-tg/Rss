<?php

require_once('vendor/autoload.php');

use Rss\Command\FeedCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$cmd = new FeedCommand();
$application->add($cmd);
$application->run();