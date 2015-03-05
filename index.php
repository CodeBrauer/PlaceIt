<?php
/**
 * PlaceIt - Placeholder Service App
 * @author  CodeBrauer <hello@gabrielw.de>
 */

require 'config/config.php';
require 'library/Helper.class.php';
require 'vendor/autoload.php';

$app = new \Slim\Slim([
    'debug' => $config['debug'],
    'mode'  => 'development',
    'view'  => new \Slim\Views\Twig(),
]);

$view = $app->view();
$view->parserOptions = [ 'debug' => $config['debug'] ];

$app->get('/', function() use ($app, $config) {
    $app->render('index.twig.php', [ 'config' => $config ]);
});

$app->get('/:size(/:color(/:text))', function ($size, $color = false, $custom_text = false) use ($app, $config) {
    if ($config['use_random_color']) {
        // generate a random color (not pure white/black...)
        $color             = $color ? Helper::convert2rgb($color) : Helper::getRandomRGBColor();
        $text_color_values = array_fill(0, 3, 255);
    } else {
        // load color from config
        $color             = $config['placeholder_colors']['background'];
        $text_color_values = $config['placeholder_colors']['text'];
    }

    $custom_text = ($custom_text === false && isset($_GET['text'])) ? $_GET['text'] : $custom_text;

    // check for file extenstion, if not given, pick png
    if (preg_match('/\./', $size)) {
        list($size, $ext) = explode('.', $size);
        $ext = $ext === 'jpg' ? 'jpeg' : $ext;
    } else {
        $ext = 'png';
    }

    // check size has 2 values, if yes split in two seperate values
    if (strpos($size, 'x') !== false) {
        list($size_x, $size_y) = explode('x', $size);
    } else {
        $size_x = $size_y = $size;
    }

    if ( $size_x == 0 || $size_y == 0 ||$size_x > $config['max_image_x'] || $size_y > $config['max_image_y'] ) {
        $app->halt(500, '<strong>Error:</strong> Image could not be created (Invalid image size)');
    }

    if (Helper::enoughMemory($size_x, $size_y) === false) {
        $app->halt(500, '<strong>Error:</strong> Image could not be created (The size is too big.)');
    }

    $img        = imagecreatetruecolor($size_x, $size_y);
    $text_color = imagecolorallocate($img, $text_color_values[0], $text_color_values[1], $text_color_values[2]);
    imagefill($img, 0, 0, imagecolorallocate($img, $color[0], $color[1], $color[2]));

    // add the text to the pictures
    if ($config['placeholder_text']['line_1'] !== false) {
        $text = ($custom_text === false) ?  $size_x.'x'.$size_y : $custom_text;
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
        $app->halt(500, '<strong>Error:</strong> Image could not be created (No output function found for: "'.$ext.'")');
    }

    imagedestroy($img);

    /**
     * Conditions
     * size-regex  => http://www.regexr.com/39tjk
     * color-regex => http://regexr.com/3a604
     */
})->conditions(
    [
        'size'  => '((\d+x+\d|\d)+\.('.implode('|', $config['valid_image_types']).'))|(\d+x+\d+)|(\d+)',
        'color' => '(\d{1,3},\d{1,3},\d{1,3})|([0-9a-f]{6})|([0-9a-f]{3})',
    ]
);

$app->run();
?>