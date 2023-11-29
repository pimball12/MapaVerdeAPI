<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public function display($file){

        $image = Storage::get($file);
        return response($image, 200)->header('Content-Type', Storage::mimeType($file));
    }

    public function storage64(Request $request)  {

        $image_64 = $request->file;
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
        $replace = substr($image_64, 0, strpos($image_64, ',')+1);

        $image = str_replace($replace, '', $image_64);
        $image = str_replace(' ', '+', $image);
        $imageName = Str::random(10) . uniqid() . '.' . $extension;
        Storage::put($imageName, base64_decode($image));


        $imageSaved = Storage::get($imageName);
        return response($imageSaved, 200)->header('Content-Type', Storage::mimeType($imageName));
    }
}
