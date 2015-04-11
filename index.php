<?php

require_once './vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$app = new Silex\Application();

$app->get('/hello/{name}', function ($name) use ($app) {
    return 'Hello ' . $app->escape($name);
});

$app->get('/gdacs', function () {

    $gdacsCrawler = new \DeepImpact\Crawlers\GdacsCrawler();
    $events       = $gdacsCrawler->getEvents();

    return json_encode($events);

});

$app->get('/reliefweb', function() {

    $rCrawler = new \DeepImpact\Crawlers\ReliefWeb();
    $events = $rCrawler->getEvents();

    return $events;

});

$app->get('/deepimpact', function () {
    return "Deep Impact";
});

$app->run();