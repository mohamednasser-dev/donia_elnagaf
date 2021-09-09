<?php


if (!function_exists('settings')) {
    function settings(){
        return App\Models\Setting::where('id', 1)->first();
    }


}
if (!function_exists('Categories')) {
    function Categories(){
        return App\Models\Category::where('type', 'product')->orderBy('id','asc')->get();
    }
}

