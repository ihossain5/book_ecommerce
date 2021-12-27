<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderStoreRequest;
use App\Http\Requests\SliderUpdateRequest;
use App\Models\Slider;
use App\Service\SliderService;
use Exception;
use Illuminate\Http\Request;

class SliderController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SliderService $sliderService) {
        $sliders = $sliderService->all();
        //dd($herosection);
        foreach ($sliders as $slider) {
            $description                  = substr($slider->description, 0, 50);
            $slider->formated_description = $description;
        }
        return view('admin.slider.slider', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderStoreRequest $request, SliderService $sliderService) {
        // dd($request->all());
        try {
            $photo = $request->image;

            $slider = $sliderService->store($request->validated(), $photo);

            $slider->message = 'Slider created successfully';

            return $this->success($slider);

        } catch (Exception $e) {

            return $this->error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider, Request $request) {
        return $this->success($slider);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SliderUpdateRequest $request, Slider $slider, sliderService $sliderService) {
        // dd($request->all());
        try {
            $slider = $sliderService->updateSlider($slider, $request);

            $slider->message = 'Slider updated successfully';

            return $this->success($slider);

        } catch (Exception $e) {

            return $this->error($e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider) {
        try {
            deleteImage($slider->image);

            $slider->delete();

            $slider->message = 'Slider deleted successfully';

            return $this->success($slider);

        } catch (Exception $e) {

            return $this->error($e->getMessage());
        }
    }
}
