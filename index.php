<?php
/**
 * PlaceIt - Placeholder Service App
 * @author  CodeBrauer <hello@gabrielw.de>
 */

require 'config.php';
require 'functions.php';
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

$app->get('/:size', function ($size) use ($app, $config) {
    $color = array(mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));


    if (preg_match('/\./', $size)) {
        $filename = $size;
        list($size, $ext) = explode('.', $size);
        $ext = $ext === 'jpg' ? 'jpeg' : $ext; 
    } else {
        $ext = 'png';
        $filename = "$size.$ext";
    }
    
    $img = imagecreate($size, $size);
    
    if ($color[0] < 166 && $color[1] < 166 && $color[2] < 166) {
        $text_color = imagecolorallocate($img, 255, 255, 255);
    } else {
        $text_color = imagecolorallocate($img, 0, 0, 0);
    }

    imagefill($img, 0, 0, imagecolorallocate($img, $color[0], $color[1], $color[2]));
    $app->response->headers->set('Content-Type', 'image/'.$ext);

    imagestring($img, 4, 25, 25, $filename, $text_color);
    $text = 'rgb('.implode(', ', $color).')';
    imagestring($img, 4, 25, 45, $text, $text_color);
    imagestring($img, 4, 25, 65, rgb2hex($color), $text_color);

    call_user_func('image'.$ext, $img); // imagepng/imagejpg/imagegif etc..

})->conditions(array('size' => '(\d+)|(\d+\.+('.implode('|', $config['valid_image_types']).'))'));

$app->run();
?>