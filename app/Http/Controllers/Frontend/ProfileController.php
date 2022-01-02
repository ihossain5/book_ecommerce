<?php

namespace App\Http\Controllers\Frontend;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_info = Auth::user();
        //dd( $user_info);


        return view('frontend.profile.my_profile',compact('user_info'));
    }


    public function update(Request $request)
    {
                //dd($request->all());
                $validator = Validator::make($request->all(), [
                    'name'       => 'required|max:100',
                    'phone'       => 'max:2000',
                    'dob'       => 'max:100',
                    'email'       => 'required|max:100',
                    'photo' => 'max:700|mimes:jpg,png,jpeg,svg|dimensions:width=190,height=190',
        
                ]);
                if ($validator->fails()) {
                    $data          = array();
                    $data['error'] = $validator->errors()->all();
                    return response()->json([
                        'success' => false,
                        'data'    => $data,
                    ]);
                } else {
                    $user_info = Auth::user();
                    $user_id=$user_info->id;
                    $user = User::find( $user_id);
        
                    $image = $request->photo;

                    //dd($viewer->photo);
                    if ($image) {
                        if($user->image!="avatar/default.png"){
                            File::delete('images/' . $user->image);
                        }
                        
                        $image_name = hexdec(uniqid());
                        $image_ext  = strtolower($image->getClientOriginalExtension());
        
                        $image_full_name = $image_name . '.' . $image_ext;
                        $image_upload_path     = 'avatar/';
                        $image_upload_path1    = 'images/avatar/';
                        $image_url       = $image_upload_path . $image_full_name;
                        $success                       = $image->move($image_upload_path1, $image_full_name);
                    } else {
                        $image_url = $user->image;
                    }
        
                    $user['name']       = $request->name;
                    $user['phone']       = $request->phone;
                    $user['date_of_birth']       = $request->dob;
                    $user['email']       = $request->email;
                    $user['image']       = $image_url;
                    $user->update();
        
                    // if(session()->has('isLogin')){
                    //     session()->pull('isLogin');
        
        
                    //     session()->flush();
                    //     session()->put('isLogin', $user);
                    // }
        
                    $data                   = array();
                    $data['message']        = 'Profile Updated successfully';
                    $data['name']          = $user->name;
                    $data['phone']    = $user->phone;
                    $data['dob']    = $user->dob;
                    $data['email']    = $user->email;
                    $data['photo']    =$user->photo;
                    $data['id']          = $user_id;
        
                    return response()->json([
                        'success' => true,
                        'data'    => $data,
                    ]);
                }
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
        //
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
    public function edit($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
