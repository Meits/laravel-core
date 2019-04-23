<?php

namespace App\Http\Controllers\Admin;

use App\Services\ImageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilesController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeFile(Request $request) {

        //upload image
        if(isset($request->upload)) {
            /**
             * FIle name
             * @var string $result
             */
            $result = ImageService::handleUploadedImageEditor(
                    $request->upload,
                    public_path().'/storage/images/blog/');
            if($result) {
                /**
                 * Response array
                 * @var array $arr
                 */
                $arr = [];
                $arr['url'] = '/storage/images/blog/'.$result;
                $arr['fileName'] = $result;
                $arr['uploaded'] = 1;
            }

            return response()->json($arr);
        }
    }
}
