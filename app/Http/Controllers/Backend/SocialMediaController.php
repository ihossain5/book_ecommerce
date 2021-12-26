<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $social_medias = SocialMedia::all();
        foreach ($social_medias as  $social_media) {
            $name  = substr($social_media->name, 0, 20);
            $social_media->name = $name;
        }

        return view('admin.social_media.social_media', compact('social_medias'));
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

            'add_name'    => 'required| max:100',
            'add_url'     => 'required|max:500|url',
            'add_photo'       => 'required|max:600|mimes:jpg,png,jpeg,svg',
        ],
        [
            'url'=>'Invalid url format',
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
                $image_upload_path2     = 'social_medias/';
                $image_upload_path3    = 'images/social_medias/';
                $image_url       = $image_upload_path2 . $image_full_name;
                $success2        = $image->move($image_upload_path3, $image_full_name);
            }


            $social_medias = SocialMedia::create([
                'name' => $request->add_name,
                'url' => $request->add_url,
                'logo'       => $image_url,

            ]);
            /// variable=>db data
            $data = array();
            $data['message'] = 'Social Media Added Successfully';
            $data['name']          = substr($social_medias->name, 0, 20);
            $data['url']       = $social_medias->url;
            $data['explode_url']       = explode("/",$social_medias->url)[2];

            $data['logo']       = $social_medias->logo;
            $data['id'] = $social_medias->id;

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
        $social_medias = SocialMedia::find($request->id);

        if ($social_medias) {
            return response()->json([
                'success' => true,
                'data'    => $social_medias,
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
            'edit_name'   => 'required|max:100',
            'edit_url'   => 'required|max:500|url',
            'edit_photo'       => 'max:600|mimes:jpg,png,jpeg,svg',
            'hidden_id'       => 'required',
        ],
        [
            'url'=>'Invalid url format',
        ]);
        if ($validator->fails()) {
            $data          = array();
            $data['error'] = $validator->errors()->all();
            return response()->json([
                'success' => false,
                'data'    => $data,
            ]);
        } else {
            $social_medias = SocialMedia::find($request->hidden_id);

            $image = $request->edit_photo;

            if ($image) {
                File::delete('images/' . $social_medias->logo);
                $image_name = hexdec(uniqid());
                $image_ext  = strtolower($image->getClientOriginalExtension());

                $image_full_name = $image_name . '.' . $image_ext;
                $image_upload_path     = 'social_medias/';
                $image_upload_path1    = 'images/social_medias/';
                $image_url       = $image_upload_path . $image_full_name;
                $success                       = $image->move($image_upload_path1, $image_full_name);
            } else {
                $image_url = $social_medias->logo;
            }


            $social_medias['name']       = $request->edit_name;
            $social_medias['url']       = $request->edit_url;
            $social_medias['logo']       = $image_url;
            $social_medias->update();

            $data                = array();
            $data['message']     = 'Social Media updated successfully';
            $data['name']       = substr($social_medias->name, 0, 20);
            $data['url']       = $social_medias->url;
            $data['explode_url']       = explode("/",$social_medias->url)[2];
            $data['logo']       = $social_medias->logo;
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
        
           //dd($request->all());
           $social_medias = SocialMedia::findOrFail($request->id);
            if ($social_medias) {
                $social_medias->delete();
                File::delete('images/' . $social_medias->logo);


                $data            = array();
                $data['message'] = 'Social Media deleted successfully';
                $data['id']      = $request->id;
                return response()->json([
                    'success' => true,
                    'data'    => $data,
                ]);
            } else {
                $data            = array();
                $data['message'] = 'Social Media can not deleted!';
                return response()->json([
                    'success' => false,
                    'data'    => $data,
                ]);
            }
    }
    
}
