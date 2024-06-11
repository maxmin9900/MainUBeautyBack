<?php

namespace App\Services;


use App\Option;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Log;

class Utility
{

    public static function deleteFile($fileUrl)
    {
        try {
            if (file_exists($fileUrl)) {
                unlink(realpath($fileUrl));
            }
        } catch (\Exception $exception) {

        }
    }

    public static function uploadFile($file, $prefix = 'uploads', $fileName = null)
    {

        $date = date('Y/m/d');
        $folder = "$prefix/$date";
        $image1 = $file->getClientOriginalName();
        if ($fileName == null) {
            $path1 = $folder . '/' . $image1;
        } else {
            $ext = strtolower(pathinfo($image1, PATHINFO_EXTENSION));
            $path1 = $folder . '/' . $fileName . '.' . $ext;
            Log::info($path1);
        }
        if (file_exists($folder) == false) {
            $fs = new Filesystem();
            $fs->makeDirectory($folder, 0755, true);
        }
        $file->move($folder, $path1);

        return $path1;
    }
}
