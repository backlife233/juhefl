<?php

if (!function_exists('is_safe_mode')) {
    function is_safe_mode()
    {
        $is = \Illuminate\Support\Facades\Cookie::get('is_safe_mode');
        return $is === '1';
    }
}

if (!function_exists('open_safe_mode')) {
    function open_safe_mode()
    {
        \Illuminate\Support\Facades\Cookie::queue('is_safe_mode', '1');
    }
}

if (!function_exists('clear_safe_mode')) {
    function clear_safe_mode()
    {
        \Illuminate\Support\Facades\Cookie::queue('is_safe_mode', '1', -1);
    }
}

if (!function_exists('safe_str')) {
    function safe_str($str)
    {
        if (!is_safe_mode()) {
            return $str;
        }

        $map = [
            '车牌' => '文章'
        ];

        return $map[$str] ?? '文章';
    }
}

if (!function_exists('safe_logo_black')) {
    function safe_logo_black()
    {
        if (is_safe_mode()) {
            return asset('assets/images/logo/logo-black.png');
        } else {
            return asset('assets/images/logo_new/logo-black.png');
        }
    }
}

if (!function_exists('safe_logo_white')) {
    function safe_logo_white()
    {
        if (is_safe_mode()) {
            return asset('assets/images/logo/logo-white2.png');
        } else {
            return asset('assets/images/logo_new/logo-black.png');
        }
    }
}

if (!function_exists('me')) {
    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    function me()
    {
        return auth()->user();
    }
}

if (!function_exists('get_version')) {
    function get_version()
    {
        return trim(exec('git log --pretty="%h" -n1 HEAD'));
    }
}

if (!function_exists('random_item')) {
    function random_item($array = [])
    {
        return $array[random_int(0, count($array) - 1)];
    }
}
