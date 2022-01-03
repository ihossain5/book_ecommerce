<?php

use Carbon\Carbon;
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

// store pdf
function storePdf($pdf, $path) {

    $pdf_name      = hexdec(uniqid());
    $ext           = strtolower($pdf->getClientOriginalExtension());
    $pdf_full_name = $pdf_name . '.' . $ext;
    $upload_path   = $path;
    $upload_path1  = 'pdfs/' . $path;
    $pdf_url       = $upload_path . $pdf_full_name;
    $success       = $pdf->move($upload_path1, $pdf_full_name);

    return $pdf_url;
}

// delete image
function deleteImage($image) {
    File::delete('images/' . $image);
}

// delete pdf
function deletePdf($pdf) {
    File::delete('pdfs/' . $pdf);
}

function englishTobangla($number) {
    $bn = ["১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০"];
    $en = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];

    return str_replace($en, $bn, $number);
}

function banglaToEnglish($number) {
    $bn = ["১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০"];
    $en = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];

    return str_replace($bn, $en, $number);
}


// format date
function formatDate($date) {
    return Carbon::parse($date)->format('d F, Y');
}

function getTotalRating($reviews) {
    $totalReviews = $reviews->count();
    $totalSum     = $reviews->sum('rating');

    return round($totalSum / $totalReviews,1);
}