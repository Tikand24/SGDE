<?php
/**
 * Created by PhpStorm.
 * User: wtorres
 * Date: 10/10/2017
 * Time: 2:36 PM
 */

namespace App\Http\Helpers;


use Illuminate\Support\Facades\Storage;

trait UploadTrait
{
    public static function uploadImage($fileFromJson, $path){


        $image_exploded = explode(',', $fileFromJson);
        $image_decoded = base64_decode($image_exploded[1]);
        if(str_contains($image_exploded[0], 'jpeg'))
            $extension = 'jpg';
        else
            $extension = 'png';

        $filename = str_random().'.'.$extension;
        $full_path = $path.$filename;
        if(Storage::put('public/'.$full_path, $image_decoded, 'public')){
            return $full_path;
        }
    }
}