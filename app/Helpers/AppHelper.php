<?php

namespace App\Helpers;

class AppHelper
{
    protected static array $chars = [
        "N" => '[0-9]',
        "A" => '[A-Z]',
        "a" => '[a-z]',
        "X" => '[A-Z0-9]',
        "Z" => '[-_@]',
    ];

    protected static string $splitPattern = '/(.)\1*/';

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

    public static function testString(string $string, string $pattern): bool
    {
        return (bool) preg_match($pattern, $string);
    }
}
