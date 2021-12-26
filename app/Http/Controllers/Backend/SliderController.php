<?php

namespace App\Http\Controllers\Backend;

use App\Models\Slider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::orderby('precedence','asc')->get();
        //dd($herosection);
        foreach ($sliders as  $slider) {
            $description  = substr($slider->description, 0, 50);
            $slider->description = $description;
        }
        return view('admin.slider.slider', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [

            'add_title'    => 'max:100|nullable',
            'add_description'       => 'max:2000|nullable',
            'add_photo'       => 'required|max:1100|mimes:jpg,png,jpeg,svg',
            'add_precedence'       => 'integer|nullable',
           
        ]);

        if ($validator->fails()) {

            $data          = array();
            $data['error'] = $validator->errors()->all();
            return response()->json([
                'success' => false,
                'data'    => $data,
            ]);
        } else {

            $image = $request->add_photo;

            if ($image) {

                $image_name = hexdec(uniqid());
                $image_ext  = strtolower($image->getClientOriginalExtension());

                $image_full_name = $image_name . '.' . $image_ext;
                $image_upload_path2     = 'sliders/';
                $image_upload_path3    = 'images/sliders/';
                $image_url       = $image_upload_path2 . $image_full_name;
                $success        = $image->move($image_upload_path3, $image_full_name);
            }

            $sliders = Slider::create([
                'title' => $request->add_title,
                'description' => $request->add_description,
                'precedence' => $request->add_precedence?? 9999,
                'image'       => $image_url,
            ]);
        
            $data = array();
            $data['message'] = 'Slider Added Successfully';
            $data['title'] = $sliders->title;
            $data['precedence'] = $sliders->precedence;
            $data['description']       = substr($sliders->description, 0, 50);
            $data['image']       = $sliders->image;

            
            $data['id'] = $sliders->id;

            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        
        //dd($request->id);
        $sliders = Slider::find($request->id);
        if ($sliders) {
            return response()->json([
                'success' => true,
                'data'    => $sliders,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data'    => 'No information found',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'edit_title'       => 'max:100|nullable',
            'edit_description'       => 'max:2000|nullable',
            'edit_precedence'       => 'nullable|integer',
            'edit_photo'       => 'max:1100|mimes:jpg,png,jpeg,svg',
            'hidden_id'       => 'required',
        ]);
        if ($validator->fails()) {
            $data          = array();
            $data['error'] = $validator->errors()->all();
            return response()->json([
                'success' => false,
                'data'    => $data,
            ]);
        } else {
            $sliders = Slider::find($request->hidden_id);

            $image = $request->edit_photo;
            if ($image) {
                File::delete('images/' . $sliders->image);
                $image_name = hexdec(uniqid());
                $image_ext  = strtolower($image->getClientOriginalExtension());

                $image_full_name = $image_name . '.' . $image_ext;
                $image_upload_path     = 'sliders/';
                $image_upload_path1    = 'images/sliders/';
                $image_url       = $image_upload_path . $image_full_name;
                $success                       = $image->move($image_upload_path1, $image_full_name);
            } else {
                $image_url = $sliders->image;
            }


            $sliders['title']       = $request->edit_title;
            $sliders['description']       = $request->edit_description;
            $sliders['precedence']       = $request->edit_precedence?? 9999;
            $sliders['image']       = $image_url;
            $sliders->update();         

            $data                = array();
            $data['message']     = 'Slider updated successfully';
            $data['title']       = $sliders->title;
            $data['precedence'] =  $sliders->precedence;
            $data['description']       = substr($sliders->description, 0, 50);
            $data['image']       = $sliders->image;
            $data['id']          = $request->hidden_id;

            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        //dd($request->id);
        $sliders = Slider::findOrFail($request->id);
        
        if ($sliders) {
            $sliders->delete();
            File::delete('images/' . $sliders->image);
            $data['message'] = 'Slider deleted successfully';
            $data['id']      = $request->id;
            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        } else {
            $data            = array();
            $data['message'] = 'Slider can not deleted!';
            return response()->json([
                'success' => false,
                'data'    => $data,
            ]);
        }
    }
}
