<?php 
/**
 * Config File for PlaceIt
 */
$config = array();

/* ============ (1) Branding options ============ */
$config['app_name']   = 'PlaceIt';
$config['app_slogan'] = 'a simple placeholding service app';

/* ============ (2) Modes ============ */
$config['debug']              = true;
$config['maintaince']         = false;
$config['maintaince_message'] = 'At the moment this service is not availble';

/* ============ (3) Placeholder generation (no photos) ============ */
$config['use_random_color'] = false;

// Default colors for placeholders (color as rgb) - only if 'use_random_color' is true
$config['placeholder_colors']['background'] = array('r' => 22, 'g' => 22, 'b' => 22);
$config['placeholder_colors']['text']       = array('r' => 38, 'g' => 248, 'b' => 0);

// image types that can be generated - these are supported,
// you can disabled one of them or add maybe some new.
$config['valid_image_types'] = array('jpg', 'jpeg', 'png', 'gif');

// default image type, if type is not given
$config['default_image_type'] = $config['valid_image_types'][2];

// font for generated placeholders and font size (size is in pt)
$config['default_font'] = 'lib/fonts/UbuntuMono-B.ttf';
$config['font_size']    = 13;

/* ============ (4) Placeholder generation (with photos) ============ */

// Filepath for Images
$config['img_path']   = 'images';