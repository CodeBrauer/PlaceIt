<?php
/**
 * PlaceIt - Placeholder Service App
 * @author  CodeBrauer <hello@gabrielw.de>
 */

require 'config.php';
require 'vendor/autoload.php';

$app = new \Slim\Slim(array(
    'log.enable' => true,
    'log.path'   => './logs',
    'log.level'  => 4,
    'debug'      => $config['debug'],
    'mode'       => 'development',
    'view'       => new \Slim\Views\Twig(),
));

$view = $app->view();
$view->parserOptions = array(
    'debug' => $config['debug'],
);

$app->get('/', function() use ($app, $config) {
    $app->render('index.php', array('config' => $config));
});

$app->get('/', function ($name) {

});

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

$app->run();
?>