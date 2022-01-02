<?php
namespace App\Service;

use App\Models\Slider;

Class SliderService {

    public $slider;

    public function __construct(Slider $slider) {
        $this->slider = $slider;
    }

    /** Get All sliders */
    function all() {
        return $this->slider->latest()->get();
    }

    /** store a publication */
    function store($data, $photo) {
        $photo_url = $this->uploadPhoto($photo);

        $slider = $this->slider->create($data);

        $slider->update(['image' => $photo_url]);

        return $slider;

    }

    function updateSlider($slider, $request) {
        $photo = $request->image;

        if ($photo) {
            deleteImage($slider->image);
            $photo_url = $this->uploadPhoto($photo);
        } else {
            $photo_url = $slider->image;
        }
        $slider->update([
            'title'       => $request->title,
            'description' => $request->description,
            'precedence'  => $request->precedence,
            'image'       => $photo_url,

        ]);

        return $slider;

    }

    function uploadPhoto($photo) {
        $path = 'sliders/';

        $photo_url = storeImage($photo, $path, 1620, 463);

        return $photo_url;
    }

    function getAllSliders(){
        return $this->slider->orderBy('precedence','ASC')->get();
    }

}