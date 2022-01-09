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

function banglaDate($date) {
    $engDATE = array('1','2','3','4','5','6','7','8','9','0','January','February','March','April',
    'May','June','July','August','September','October','November','December','Saturday','Sunday',
    'Monday','Tuesday','Wednesday','Thursday','Friday');
    $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে',
    'জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার','
    বুধবার','বৃহস্পতিবার','শুক্রবার' 
    );
    $date=formatDate($date);
    return str_replace($engDATE, $bangDATE, $date);
}

function getTotalRating($reviews) {
    $totalReviews = $reviews->count();
    $totalSum     = $reviews->sum('rating');

    if($totalReviews >0){
        return round($totalSum / $totalReviews,1);
    }else{
        return 0;
    }
}