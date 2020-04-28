<?php


if (!function_exists('isActiveRoute')) {
    function isActiveRoute($routeName)
    {
        $currentRoute = Route::getCurrentRoute()->getName();
        if ($routeName === $currentRoute) {
            return true;
        }
        return false;
    }
}

if (!function_exists('getAuthAdmin')) {
    function getAuthAdmin()
    {
        $admin = auth('admin')->user();
        return $admin;
    }
}

if (!function_exists('getAuthAdminBrandId')) {
    function getAuthAdminBrandId()
    {
        return auth('admin')->user()->brand_id;
    }
}

if (!function_exists('decodeFormatNumber')) {
    // 123,456 => 123456
    function decodeFormatNumber($formatNumber)
    {
        $number = str_replace(',', '', $formatNumber);
        return $number;
    }
}
