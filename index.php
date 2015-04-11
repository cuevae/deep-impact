<?php

require_once __DIR__ . '/vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$app = new Silex\Application();

$app->get('/hello/{name}', function($name) use($app) {
    return 'Hello '.$app->escape($name);
});

$app->get('/test', function(){

    echo "Test";


    $seedData = array(
        array(
            'decade' => '1970s',
            'artist' => 'Debby Boone',
            'song' => 'You Light Up My Life',
            'weeksAtOne' => 10
        ),
        array(
            'decade' => '1980s',
            'artist' => 'Olivia Newton-John',
            'song' => 'Physical',
            'weeksAtOne' => 10
        ),
        array(
            'decade' => '1990s',
            'artist' => 'Mariah Carey',
            'song' => 'One Sweet Day',
            'weeksAtOne' => 16
        ),
    );

    $uri = "mongodb://IbmCloud_u9modlj8_t58o1t4v_svptlk2h:pyCO2HCN3ICErtsJWj-EhDhxP3CZeGJe@ds049570.mongolab.com:49570/IbmCloud_u9modlj8_t58o1t4v?replicaSet=rs-ds049570";
    $options = array("connectTimeoutMS" => 30000);

    $client = new MongoClient($uri, $options );
    $db = $client->selectDB("IbmCloud_u9modlj8_t58o1t4v");

    $songs = $db->songs;
    // To insert a dict, use the insert method.
    $songs->batchInsert($seedData);


    $songs->update(
        array('artist' => 'Mariah Carey'),
        array('$set' => array('artist' => 'Mariah Carey ft. Boyz II Men'))
    );

    $query = array('weeksAtOne' => array('$gte' => 10));
    $cursor = $songs->find($query)->sort(array('decade' => 1));
    foreach($cursor as $doc) {
        echo 'In the ' .$doc['decade'];
        echo ', ' .$doc['song'];
        echo ' by ' .$doc['artist'];
        echo ' topped the charts for ' .$doc['weeksAtOne'];
        echo ' straight weeks.', "\n";
    }
    // Since this is an example, we'll clean up after ourselves.
    $songs->drop();
    // Only close the connection when your app is terminating
    $client->close();

    return 'This is test endpoint';

});

$app->get('/deepimpact/', function(){
    return "";
});

$app->run();