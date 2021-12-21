<?php

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;


// store image
function storeImage($image, $path, $width, $height) {

    $image_name      = hexdec(uniqid());
    $ext             = strtolower($image->getClientOriginalExtension());
    $image_full_name = $image_name . '.' . $ext;
    $upload_path     = $path;
    $upload_path1    = 'images/' . $path;
    $image_url       = $upload_path . $image_full_name;
    // $success         = $image->move($upload_path1, $image_full_name);

    $img = Image::make($image)->resize($width, $height);
    $img->save($upload_path1 . $image_full_name, 75);

    return $image_url;
}

function deleteImage($image) {
    File::delete('images/' . $image);
}