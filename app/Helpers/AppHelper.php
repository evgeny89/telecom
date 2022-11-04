<?php

namespace App\Helpers;

class AppHelper
{
    /**
     * array for compare mask to pattern
     *
     * @var array|string[]
     */
    protected static array $chars = [
        "N" => '[0-9]',
        "A" => '[A-Z]',
        "a" => '[a-z]',
        "X" => '[A-Z0-9]',
        "Z" => '[-_@]',
    ];

    /**
     * build regex patter from mask
     *
     * @param string $mask
     * @return string
     */
    public static function makePattern(string $mask): string
    {
        $compressArray = self::compressMask($mask);
        return self::createPattern($compressArray);
    }

    /**
     * checking a string against a regular expression
     *
     * @param string $string
     * @param string $pattern
     * @return bool
     */
    public static function testString(string $string, string $pattern): bool
    {
        return (bool) preg_match($pattern, $string);
    }

    /**
     * compress string
     *
     * @param $mask
     * @return array
     */
    protected static function compressMask($mask): array
    {
        $compressArray = [];
        $char = $mask[0];
        $count = 0;
        foreach (str_split($mask) as $ch) {
            if ($char === $ch) {
                ++$count;
            } else {
                $compressArray[] = "{$char}:{$count}";
                $char = $ch;
                $count = 1;
            }
        }

        $compressArray[] = "{$char}:{$count}";

        return $compressArray;
    }

    /**
     * create type pattern
     *
     * @param $arr
     * @return string
     */
    protected static function createPattern($arr): string
    {
        $pattern = "/^";
        foreach ($arr as $compressString) {
            [$char, $count] = explode(":", $compressString);
            $pattern .= self::$chars[$char] . "{{$count}}";
        }
        $pattern .= "$/";

        return $pattern;
    }
}
