<?php

require_once('vendor/autoload.php');

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;

$request = Request::createFromGlobals();
$category = $request->get('category');

$response = new Response();

    if (isset($category) && $category != null ) {
        ob_start();
        include 'feeds.php';
        $response->setContent(ob_get_clean());
    } else {
        $response->setStatusCode(404);
        $response->setContent('Not Found');
    }

$response->send();