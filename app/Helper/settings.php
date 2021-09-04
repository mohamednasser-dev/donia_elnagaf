<?php


if (!function_exists('settings')) {
    function settings()
    {
        return App\Models\Setting::where('id', 1)->first();
    }
}

