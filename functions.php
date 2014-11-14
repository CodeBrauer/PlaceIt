<?php

/**
 * converts an rgb array to a hex string (css-like)
 * @param  array $rgb rgb codes
 * @return string the hexcode
 */
function rgb2hex($rgb)
{
    $hex = '#';
    $hex .= str_pad(dechex($rgb[0]), 2, '0', STR_PAD_LEFT);
    $hex .= str_pad(dechex($rgb[1]), 2, '0', STR_PAD_LEFT);
    $hex .= str_pad(dechex($rgb[2]), 2, '0', STR_PAD_LEFT);

    return $hex;
}
?>