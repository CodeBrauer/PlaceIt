<?php
/**
 * Config File for PlaceIt
 */
$config = [];

/* ============ (1) Branding options ============ */
$config['app_name']   = 'PlaceIt';
$config['app_slogan'] = 'a simple placeholding service app';

/* ============ (2) Modes ============ */
$config['debug']              = true;
$config['maintaince']         = false;
$config['maintaince_message'] = 'At the moment this service is not availble';

/* ============ (3) Placeholder generation (no photos) ============ */
$config['use_random_color'] = true;

// Default colors for placeholders (color as rgb) - only if 'use_random_color' is true
$config['placeholder_colors']['background'] = [ 22, 22, 22 ];
$config['placeholder_colors']['text']       = [ 38, 248, 0 ];

// enable/disable placeholder text
$config['placeholder_text']['line_1'] = true;
$config['placeholder_text']['line_2'] = true;
$config['placeholder_text']['line_3'] = true;

// image types that can be generated - these are supported,
// you can disabled one of them or add maybe some new.
$config['valid_image_types'] = [ 'jpg', 'jpeg', 'png', 'gif', ];

// default image type, if type is not given
$config['default_image_type'] = $config['valid_image_types'][2];

// font for generated placeholders and font size (size is in pt)
$config['default_font'] = 'library/fonts/UbuntuMono-B.ttf';
$config['font_size']    = 13;

// max size that can be generated
$config['max_image_x'] = 2500;
$config['max_image_y'] = 2500;

/* ============ (4) Placeholder generation (with photos) ============ */

// Filepath for Images
$config['img_path']   = 'images';