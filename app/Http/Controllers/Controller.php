<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function MoveImage($request_file,$public_path)
    {
        // This is Image Information ...
        $file = $request_file;
        $ext = $file->getClientOriginalExtension();
        $size = $file->getSize();
        // Move Image To Folder ..
        $fileNewName = 'file' . $size . '_' . time() . '.' . $ext;
        $file->move(public_path($public_path), $fileNewName);
        return $fileNewName;
    }
}
