<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EmployeeController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $employees = User::where('id', '!=', 1)->get();
        return view('admin.employee', compact('employees'));
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
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|max:50',
            'email'       => 'required|max:50|email|unique:users',
            'phone'       => 'required|max:50',
            'profile_image'       => 'nullable|max:600|mimes:jpg,png,jpeg',
        ]);
        if ($validator->fails()) {
            $data          = array();
            $data['error'] = $validator->errors()->all();
            return response()->json([
                'success' => false,
                'data'    => $data,
            ]);
        } else {
            $profile_image = $request->profile_image;
            
            if ($profile_image) {
                $profile_image_name = hexdec(uniqid());
                $profile_image_ext  = strtolower($profile_image->getClientOriginalExtension());

                $profile_image_image_full_name = $profile_image_name . '.' . $profile_image_ext;
                $profile_image_upload_path     = 'avatar/';
                $profile_image_upload_path1    = 'images/avatar';
                $profile_image_image_url       = $profile_image_upload_path . $profile_image_image_full_name;
                $success                       = $profile_image->move($profile_image_upload_path1, $profile_image_image_full_name);
                // $img = Image::make($image)->resize(680, 437);
                // $img->save($upload_path1 . $image_full_name, 60);
            }
            $random   = Str::random(20);
            $employee = User::create([
                'name'        => $request->name,
                'email'       => $request->email,
                'phone'       => $request->phone,
                'password'    => bcrypt($random),
                'image'       => $profile_image_image_url,
                'is_admin'    => 1,
            ]);
            Mail::send('password_mail', ['password' => $random, 'email' => $request->email], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Greetings');
            });
            $data                = array();
            $data['message']     = 'Admin added successfully';
            $data['name']        = $employee->name;
            $data['email']       = $employee->email;
            $data['phone']       = $employee->phone;
            $data['id']          = $employee->id;

            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request) {
        $data = User::findOrFail($request->id);

        if ($data) {

            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data'    => 'No information found',
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request) {
        $data = User::findOrFail($request->id);
        if ($data) {
            
            return response()->json([
                'success' => true,
                'data'    => $data,
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
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee) {
        // dd($request->all());
        $employee  = User::findOrFail($request->hidden_id);
        $validator = Validator::make($request->all(), [
            'name'        => 'required|max:50',
            'email'       => 'required|max:50|email|unique:users,email,' . $employee->id,
            'phone'       => 'required|max:50',
            'profile_image'       => 'nullable|max:600|mimes:jpg,png,jpeg',
        ]);
        if ($validator->fails()) {
            $data          = array();
            $data['error'] = $validator->errors()->all();
            return response()->json([
                'success' => false,
                'data'    => $data,
            ]);
        } else {

            
            $profile_image = $request->profile_image;
           
            if ($profile_image) {
                File::delete(public_path('images/' . $employee->image));
                $profile_image_name = hexdec(uniqid());
                $profile_image_ext  = strtolower($profile_image->getClientOriginalExtension());

                $profile_image_image_full_name = $profile_image_name . '.' . $profile_image_ext;
                $profile_image_upload_path     = 'avatar/';
                $profile_image_upload_path1    = 'images/avatar';
                $profile_image_image_url       = $profile_image_upload_path . $profile_image_image_full_name;
                $success                       = $profile_image->move($profile_image_upload_path1, $profile_image_image_full_name);
                // $img = Image::make($image)->resize(680, 437);
                // $img->save($upload_path1 . $image_full_name, 60);
            } else {
                $profile_image_image_url = $employee->image;
            }
            $employee->update([
                'name'        => $request->name,
                'email'       => $request->email,
                'phone'       => $request->phone,
                'image'       => $profile_image_image_url,
                'is_admin'    => 1,
            ]);
            

            $data                = array();
            $data['message']     = 'Data has been updated.';
            $data['name']        = $employee->name;
            $data['email']       = $employee->email;
            $data['phone']       = $employee->phone;
            $data['id']          = $employee->id;
            

            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) {
        $employee = User::findOrFail($request->id);
        if ($employee->id == auth()->user()->id) {
            return response()->json([
                'message' => 'You can not delete your own data',
            ]);
        }  else {
            $employee->delete();
            File::delete(public_path('images/' . $employee->signature));
            $data['message'] = 'Data deleted successfully';
            $data['id']      = $request->id;

            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        }

    }
}
