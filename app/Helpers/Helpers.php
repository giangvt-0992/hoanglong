<?php

use Illuminate\Support\Facades\DB;

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

if (!function_exists('decodeDurationJson')) {
    // 123,456 => 123456
    function decodeDurationJson($duration)
    {
        $duration = json_decode($duration);
        $durationStr = "$duration->hours" . "h$duration->minutes'";
        return $durationStr;
    }
}

// if (!function_exists('decodeDurationJson')) {
//     // 123,456 => 123456
//     function decodeDurationJson($duration)
//     {
//         $duration = json_decode($duration);
//         $durationStr = "$duration->hours" . "h$duration->minutes'";
//         return $durationStr;
//     }
// }
if (!function_exists('isDuplicateArray')) {
    function isDuplicateArray($array)
    {
        return count($array) != count(array_unique($array));
    }
}

if (!function_exists('insertArrayData')) {
    function insertArrayData($tableName ,$arrayData)
    {
        $insertDataCollect = collect($arrayData);
        $chunks = $insertDataCollect->chunk(200);
        try {
            DB::transaction(function() use ($chunks, $tableName){
                foreach ($chunks as $chunk) {
                    DB::table($tableName)->insertOrIgnore($chunk->toArray());
                }
            });
        } catch (\Throwable $th) {
            return false;
        }
        return true;
    }
}
