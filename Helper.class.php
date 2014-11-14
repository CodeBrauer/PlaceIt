<?php

/**
* Helper Functions for PlaceIT
*/
class Helper
{

    /**
    * converts an rgb array to a hex string (css-like)
    * @param  array $rgb rgb codes
    * @param  bool $uppercase makes the rgb uppercase
    * @return string  the hexcode
    */
    public static function rgb2hex($rgb, $uppercase = false)
    {
        $hex = '#';
        $hex .= str_pad(dechex($rgb[0]), 2, '0', STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb[1]), 2, '0', STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb[2]), 2, '0', STR_PAD_LEFT);

        return $hex;
    }

}
