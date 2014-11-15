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
    $app->render('index.twig.php', array('config' => $config));
});

$app->get('/:size(/:text)', function ($size, $custom_text = false) use ($app, $config) {
    if ($config['use_random_color']) {
        // generate a random color (not pure white/black...)
        $color             = array(mt_rand(25, 215), mt_rand(25, 215), mt_rand(25, 215));
        $text_color_values = array(255, 255, 255);
    } else {
        // load color from config
        $color             = $config['placeholder_colors']['background'];
        $text_color_values = $config['placeholder_colors']['text'];
    }

    if ($custom_text === false && isset($_GET['text'])) {
        $custom_text = $_GET['text'];
    }

    // check for file extenstion, if not given, pick png
    if (preg_match('/\./', $size)) {
        list($size, $ext) = explode('.', $size);
        $ext = $ext === 'jpg' ? 'jpeg' : $ext; 
    } else {
        $ext = 'png';
    }

    $img        = imagecreatetruecolor($size, $size);
    $text_color = imagecolorallocate($img, $text_color_values[0], $text_color_values[1], $text_color_values[2]);
    imagefill($img, 0, 0, imagecolorallocate($img, $color[0], $color[1], $color[2]));

    // add the text to the pictures
    if ($config['placeholder_text']['line_1'] !== false) {
        $text = ($custom_text === false) ?  $size.'x'.$size : $custom_text;
        imagettftext($img, $config['font_size'], 0, 20, 30, $text_color, $config['default_font'], $text);
    }
    if ($config['placeholder_text']['line_2'] !== false) {
        $text = Helper::rgb2hex($color);
        imagettftext($img, $config['font_size'], 0, 20, 55, $text_color, $config['default_font'], $text);
    }
    if ($config['placeholder_text']['line_3'] !== false) {
        $text = 'rgb('.implode(', ', $color).')';
        imagettftext($img, $config['font_size'], 0, 20, 80, $text_color, $config['default_font'], $text);
    }
    
    if (function_exists('image'.$ext)) {
        $app->response->headers->set('Content-Type', 'image/'.$ext);
        call_user_func('image'.$ext, $img); // imagepng/imagejpg/imagegif etc..
    } else {
        $app->halt(500, 'Image could not be created (No output function found for: "'.$ext.'")');
    }

    // conditions-regex => (http://www.regexr.com/39tjk)
})->conditions(array('size' => '((\d+x+\d|\d)+\.('.implode('|', $config['valid_image_types']).'))|(\d+x+\d+)|(\d+)'));

$app->run();
?>