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

    /**
     * converts a hex color to an rgb array
     * @param  string $color hex color code (without '#'!)
     * @return array rgb codes
     */
    public static function hex2rgb($color)
    {
        list($r, $g, $b) = [ $color[0].$color[1], $color[2].$color[3], $color[4].$color[5] ];
        $r = hexdec($r);
        $g = hexdec($g);
        $b = hexdec($b);

        return [ $r, $g, $b ];
    }

    /**
     * converts hex or rgb string to rgb array
     * @param  string $color_code a rgb-code or hex-code
     * @return array rgb-colors
     * @example Formats:
     * rgb: convert_to_rgb('223,57,124');
     * hex: convert_to_rgb('f2af4a');
     * hex: convert_to_rgb('f2f');
     */
    public static function convert2rgb($color_code)
    {
        if (preg_match('/(\d{1,3},\d{1,3},\d{1,3})/', $color_code)) {   // check for RGB
            $arr = explode(',', $color_code);
            return max($arr) > 255 ? false : $arr;
        } else if (preg_match('/([0-9a-fA-F]{6})/', $color_code)) {        // check for 6-char hex
            return self::hex2rgb($color_code);
        } else if (preg_match('/([0-9a-fA-F]{3})/', $color_code)) {        // check for 3-char hex
            $color_code_6  = $color_code[0].$color_code[0];
            $color_code_6 .= $color_code[1].$color_code[1];
            $color_code_6 .= $color_code[2].$color_code[2];
            return self::hex2rgb($color_code_6);
        }
        return false;
    }

    /**
     * returns a random color thats not pure white/black in RGB
     * @return array RGB
     */
    public static function getRandomRGBColor()
    {
        return array_fill(0, 3, mt_rand(25, 215));
    }

    /**
     * checks a image can be generated with the current memory limit
     * @param  int  $x   width of the image
     * @param  int  $y   height of the image
     * @param  int $rgb rgb = 3 colors
     * @return bool true if image can be generated
     */
    public static function enoughMemory($x, $y, $rgb = 3)
    {
        $max_mem = ini_get('memory_limit');
        return ($x * $y * $rgb * 1.8) < (self::calcBytes($max_mem) - memory_get_usage());
    }

    /**
     * check max image size that can be generated (locked by php_value memory_limit)
     * @todo doesn't work so well now..
     * @return int max image size in px
     */
    public static function getMaxImageSize()
    {
        $rgb = 3;
        $max_mem = ini_get('memory_limit');
        for ($i=0; $i < PHP_INT_MAX; $i += 300) {
            $test = ($i * $i * $rgb * 1.8) < self::calcBytes($max_mem);
            if ($test === false) {
                return $i;
                break;
            }

        }
    }

    /**
     * get all photos from the img_path with allowed filetypes [description]
     * @return array numeric, relative path to images
     */
    public static function getRawImages()
    {
        global $config;

        $dir        = $config['img_path'];
        $file_types = implode('|', $config['valid_photo_filetypes']);

        if ( file_exists($dir) === false) {
            return false;
        }

        $files  = glob($dir . '*');

        $images = preg_grep('/(' . $file_types . ')/i', $files);

        return array_values($images);
    }

    /**
     * not documented yet, function doen't work fine at all
     * @todo doc it!
     * @param  [type]  $x             [description]
     * @param  [type]  $y             [description]
     * @param  [type]  $longestLength [description]
     * @param  boolean $allowDistort  [description]
     * @return [type]                 [description]
     */
    public static function getImageScale($x, $y, $longestLength, $allowDistort = false) {
        //Set the default NEW values to be the old, in case it doesn't even need scaling
        list($nx, $ny) = array($x, $y);
            if ($x > $y) {
                if ($longestLength > $x && !$allowDistort) {
                    return array($x, $y);
                }
                $r = $x / $longestLength;
                return array($longestLength, $y / $r);
            } else {
                if ($longestLength > $x && !$allowDistort) {
                    return array($x, $y);
                }
                $r = $y / $longestLength;
                return array($x / $r, $longestLength);
            }
        return array($nx, $ny);
    }

    /**
     * calculates the php.ini-values to bytes
     * @link http://php.net/ini_get
     * @param  string $value a value from php.ini (like 8M or 1G)
     * @return int bytes
     */
    private static function calcBytes($value) {
        $value     = trim($value);
        $last_char = strtolower($value[strlen($value)-1]);
        switch($last_char) {
            case 'g': $value *= 1024;
            case 'm': $value *= 1024;
            case 'k': $value *= 1024;
        }
        return (int)$value;
    }

}