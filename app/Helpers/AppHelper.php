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
     * RegEx for split mask to same chars together
     *
     * @var string
     */
    protected static string $splitPattern = '/(.)\1*/';

    /**
     * build regex patter from mask
     *
     * @param string $mask
     * @return string
     */
    public static function makePattern(string $mask): string
    {
        preg_match_all(self::$splitPattern, $mask, $matches);
        $patternsArray = array_map(function ($match) {
            $count = strlen($match);
            return self::$chars[substr($match, 0 , 1)]. "{{$count}}";
        }, $matches[0]);
        $pattern = implode("", $patternsArray);
        return "/^{$pattern}$/";
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
}
