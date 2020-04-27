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
