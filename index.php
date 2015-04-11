<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once './vendor/autoload.php';

use \Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

$app->get('/hello/{name}', function ($name) use ($app) {
    return 'Hello ' . $app->escape($name);
});

$app->get('/gdacs', function () {

    $gdacsCrawler = new \DeepImpact\Crawlers\GdacsCrawler();
    $events       = $gdacsCrawler->getEvents();

    $headers = array('Content-type' => 'application/json');
    return new Response(json_encode($events), 200, $headers);

});

$app->get('/reliefweb', function() {

    $rCrawler = new \DeepImpact\Crawlers\ReliefWebCrawler();
    $events = $rCrawler->getEvents();

    $headers = array('Content-type' => 'application/json');
    return new Response($events, 200, $headers);

});

$app->get('/nasa-schedule', function(){

    $nsc = new \DeepImpact\Crawlers\NasaMissionCrawler();
    $events = $nsc->getEvents();

    $headers = array('Content-type' => 'application/json');
    return new Response($nsc, 200, $headers);

});

$app->get('/', function(){
    return new Response('Welcome to SkyGlass API.', 200);
});

$app->run();