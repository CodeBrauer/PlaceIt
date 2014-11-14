<?php 
/**
 * Config File for PlaceIt
 */
$config = array();

// Branding options
$config['app_name']   = 'PlaceIt';
$config['app_slogan'] = 'a simple placeholding service app';

// Modes
$config['debug']              = true;
$config['maintaince']         = false;
$config['maintaince_message'] = 'At the moment this service is not availble';

// Filepath for Images
$config['img_path']   = 'images';

// Default colors for placeholders (color as rgb)
$config['placeholder_colors']['background'] = array('r' => 22, 'g' => 22, 'b' => 22);
$config['placeholder_colors']['text']       = array('r' => 38, 'g' => 248, 'b' => 0);

// image types that can be generated - these are supported.
$config['valid_image_types'] = array('jpg', 'jpeg', 'png', 'gif');

// default image type, if type is not given
$config['default_image_type'] = $config['valid_image_types'][2];

// font for generated placeholders
$config['default_font'] = 'lib/fonts/UbuntuMono-B.ttf';
$config['font_size']    = 13;