<?php

namespace App\Http\Helper;

class ApiHelper
{
    protected static $baseUrl;

    public static function init()
    {
        self::$baseUrl = env('API_TAB');
    }

    public static function baseUrl()
    {
        if (!self::$baseUrl) {
            self::init();
        }

        return self::$baseUrl;
    }

    public static function apiUrl($path)
    {
        return self::baseUrl() . '/' . ltrim($path, '/');
    }
}
