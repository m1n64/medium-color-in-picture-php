<?php
namespace Vasqo\Mediumcolor\ColorConverter;


class Converter
{
    /**
     * @param int $r
     * @param int $g
     * @param int $b
     * @return string
     */
    public static function rgbToHEX(int $r, int $g, int $b): string
    {
        return sprintf(
            "#%02X%02X%02X",
            $r,
            $g,
            $b
        );
    }

    /**
     * @param int $r
     * @param int $g
     * @param int $b
     * @return string
     */
    public static function rgbToString(int $r, int $g, int $b): string
    {
        return sprintf(
            "rgb(%u,%u,%u)",
            $r,
            $g,
            $b
        );
    }
}