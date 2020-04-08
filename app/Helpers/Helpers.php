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
