<?php
/**
 * Created by PhpStorm.
 * User: Meits
 * Date: 08-Apr-19
 * Time: 17:03
 */

namespace App\Services\File;

use File;


class FileContentService
{
    public function getFileContent($path) {
        $content = "";
        if(file_exists($path)) {
            $content = File::get($path);
        }

        return $content;
    }

    public function setFileContent($path, $content) {
        File::put($path, $content);
    }
}