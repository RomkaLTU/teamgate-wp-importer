<?php

/**
 * @package php-string-helpers
 * @link https://github.com/bayfrontmedia/php-string-helpers
 * @author John Robinson <john@bayfrontmedia.com>
 * @copyright 2020 Bayfront Media
 */

namespace Bayfront\StringHelpers;

class Str
{

    /**
     * Checks if string contains a case-sensitive needle.
     *
     * @param string $string
     * @param string $needle
     *
     * @return bool
     */

    public static function has(string $string, string $needle): bool
    {
        return strpos($string, $needle) !== false;
    }

    /**
     * Checks if string contains any whitespace.
     *
     * @param string $string
     *
     * @return bool
     */

    public static function hasSpace(string $string): bool
    {
        return strpos($string, ' ') !== false;
    }

    /**
     * Checks if a string starts with a given case-sensitive string.
     *
     * @param string $string
     * @param string $starts_with
     *
     * @return bool
     */

    public static function startsWith(string $string, string $starts_with = ''): bool
    {
        return (substr($string, 0, strlen($starts_with)) === $starts_with);
    }

    /**
     * Checks if a string ends with a given case-sensitive string.
     *
     * @param string $string
     * @param string $ends_with
     *
     * @return bool
     */

    public static function endsWith(string $string, string $ends_with = ''): bool
    {

        $length = strlen($ends_with);

        return $length === 0 || (substr($string, -$length) === $ends_with);

    }

    /**
     * Returns string, ensuring that it starts with a given string.
     *
     * @param string $string
     * @param string $start_with
     *
     * @return string
     */

    public static function startWith(string $string, string $start_with = ''): string
    {

        if (!self::startsWith($string, $start_with)) {

            return $start_with . $string;

        }

        return $string;

    }

    /**
     * Returns string, ensuring that it ends with a given string.
     *
     * @param string $string
     * @param string $end_with
     *
     * @return string
     */

    public static function endWith(string $string, string $end_with = ''): string
    {

        if (!self::endsWith($string, $end_with)) {

            return $string . $end_with;

        }

        return $string;

    }

    /**
     * Converts string to lowercase using a specified character encoding.
     *
     * See: https://www.php.net/manual/en/mbstring.supported-encodings.php
     *
     * @param string $string
     * @param string $encoding
     *
     * @return string
     */

    public static function lowercase(string $string, string $encoding = 'UTF-8'): string
    {
        return mb_convert_case($string, MB_CASE_LOWER, $encoding);
    }

    /**
     * Converts string to uppercase using a specified character encoding.
     *
     * See: https://www.php.net/manual/en/mbstring.supported-encodings.php
     *
     * @param string $string
     * @param string $encoding
     *
     * @return string
     */

    public static function uppercase(string $string, string $encoding = 'UTF-8'): string
    {
        return mb_convert_case($string, MB_CASE_UPPER, $encoding);
    }

    /**
     * Converts string to title case using a specified character encoding.
     *
     * @param string $string
     * @param string $encoding
     *
     * @return string
     */

    public static function titleCase(string $string, string $encoding = 'UTF-8'): string
    {
        return mb_convert_case($string, MB_CASE_TITLE, $encoding);
    }

    /**
     * Converts string to camel case, removing any non-alpha and non-numeric characters.
     *
     * @param string $string
     *
     * @return string
     */

    public static function camelCase(string $string): string
    {

        // Non-alpha and non-numeric characters become spaces

        $string = preg_replace("/[^a-z0-9]+/i", " ", $string);

        $string = ucwords(strtolower(trim($string)));

        return lcfirst(str_replace(" ", "", $string));

    }

    /**
     * Converts string to kebab case (URL-friendly slug), replacing any non-alpha
     * and non-numeric characters with a hyphen.
     *
     * @param string $string
     * @param bool $lowercase (Convert string to lowercase)
     *
     * @return string
     */

    public static function kebabCase(string $string, bool $lowercase = false): string
    {

        // Replace non letter or digit with hyphen (-)
        $string = preg_replace('/[^a-z0-9]+/i', '-', $string);

        // Transliterate
        $string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);

        // Trim
        $string = trim($string, '-');

        // Remove duplicate -
        $string = preg_replace('/-+/', '-', $string);

        if (true === $lowercase) {

            return self::lowercase($string);

        }

        return $string;

    }

    /**
     * Converts string to snake case, replacing any non-alpha
     * and non-numeric characters with an underscore.
     *
     * @param string $string
     * @param bool $lowercase (Convert string to lowercase)
     *
     * @return string
     */

    public static function snakeCase(string $string, bool $lowercase = true): string
    {

        // Replace non letter or digit with underscore (_)
        $string = preg_replace('/[^a-z0-9]+/i', '_', $string);

        // Transliterate
        $string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);

        // Trim
        $string = trim($string, '_');

        // Remove duplicate _
        $string = preg_replace('/_+/', '_', $string);

        if (true === $lowercase) {

            return self::lowercase($string);

        }

        return $string;

    }

    /**
     * Return a random string of specified length and type.
     *
     * Type of "all" includes alphanumeric and special characters.
     *
     * Note: Returned string is not cryptographically secure.
     *
     * @param int $length
     * @param string $type (Valid types include: nonzero, alpha, numeric, alphanumeric, and all)
     *
     * @return string
     */

    public static function random(int $length = 8, string $type = 'all'): string
    {

        $alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $nonzero = '123456789';
        $numeric = '0123456789';
        $special = '-=/\[];,.~!@#$%^&*()_+{}|:?<>';

        if ($type == 'nonzero') {

            $chars = $nonzero;

        } else if ($type == 'alpha') {

            $chars = $alpha;

        } else if ($type == 'numeric') {

            $chars = $numeric;

        } else if ($type == 'alphanumeric') {

            $chars = $nonzero . $alpha . $numeric;

        } else { // Default (all)

            $chars = $nonzero . $alpha . $numeric . $special;

        }

        $pieces = [];

        $max = mb_strlen($chars, '8bit') - 1;

        for ($i = 0; $i < $length; ++$i) {

            $pieces [] = $chars[random_int(0, $max)];

        }

        return implode('', $pieces);

    }

    /**
     * Return a UUID v4 string.
     *
     * @return string
     */

    public static function uuid(): string
    {

        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );

    }

}