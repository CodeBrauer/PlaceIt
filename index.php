<?php
/**
 * PlaceIt - Placeholder Service App
 * @author  CodeBrauer <hello@gabrielw.de>
 */

require 'config.php';
require 'Helper.class.php';
require 'vendor/autoload.php';

$app = new \Slim\Slim(array(
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
    // generate a random color (not pure white/black...)
    $color = array(mt_rand(25, 215), mt_rand(25, 215), mt_rand(25, 215));

    // check for file extenstion, if not given, pick png
    if (preg_match('/\./', $size)) {
        list($size, $ext) = explode('.', $size);
        $ext = $ext === 'jpg' ? 'jpeg' : $ext; 
    } else {
        $ext = 'png';
    }

    $img        = imagecreatetruecolor($size, $size);
    $text_color = imagecolorallocate($img, 255, 255, 255);

    imagefill($img, 0, 0, imagecolorallocate($img, $color[0], $color[1], $color[2]));

    // add the text to the pictures
    imagettftext($img, $config['font_size'], 0, 20, 30, $text_color, $config['default_font'], $size.'x'.$size);
    $text = 'rgb('.implode(', ', $color).')';
    imagettftext($img, $config['font_size'], 0, 20, 55, $text_color, $config['default_font'], Helper::rgb2hex($color));
    imagettftext($img, $config['font_size'], 0, 20, 80, $text_color, $config['default_font'], $text);


    $app->response->headers->set('Content-Type', 'image/'.$ext);
    call_user_func('image'.$ext, $img); // imagepng/imagejpg/imagegif etc..

// conditions-regex => (http://www.regexr.com/39tjk)
})->conditions(array('size' => '((\d+x+\d|\d)+\.('.implode('|', $config['valid_image_types']).'))|(\d+x+\d+)|(\d+)'));

$app->run();
?>