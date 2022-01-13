<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminStoreRequest;
use App\Mail\SendMail;
use App\Mail\SendMain;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminController extends Controller {
    public function adminLogin() {
        return view('admin.login');
    }
    public function index() {
        // dd('data');
        return view('admin.dashboard');
    }
    public function passwordChange() {
        return view('admin.password_change');
    }
    public function updatePassword(Request $request) {
        if (Auth::check()) {
            $data = $request->validate([
                'old_password' => 'required',
                'password'     => 'required|confirmed',
            ]);
            $currentPassword = Auth::User()->password;
            if (Hash::check($data['old_password'], $currentPassword)) {
                $userId         = Auth::User()->id;
                $user           = User::find($userId);
                $user->password = Hash::make($data['password']);
                $user->save();
                Auth::logout();
                return redirect()->route('login')->with('message', 'Password change successfully. Please Login again');
            } else {
                return back()->withErrors(['Sorry, your current password was not recognised. Please try again.']);
            }
        }
    }
    public function profile() {
        $user = Auth::user();
        return view('admin.profile_update', compact('user'));
    }
    public function profileUpdate(Request $request) {
        $user = Auth::user();
        $this->validate($request, [
            'name'        => 'required|max:100',
            'phone'       => 'required|max:11|min:11
            ',
            'email'       => 'required|max:100|email|unique:users,email,' . $user->id,

        ]);
        $image = $request->image;
        if ($image) {
            if ($user->image != null) {
                File::delete(public_path('images/' . $user->image));
            }
            $image_name = hexdec(uniqid());
            $ext        = strtolower($image->getClientOriginalExtension());

            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'avatar/';
            $upload_path1    = 'images/avatar';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path1, $image_full_name);
            // $img = Image::make($image)->resize(680, 437);
            // $img->save($upload_path1 . $image_full_name, 60);

        } else {
            $image_url = $user->image;
        }
        $user->update([
            'name'        => $request->name,
            'image'       => $image_url,
            'phone'       => $request->phone,
            'email'       => $request->email,

        ]);
        return redirect()->back()->with('success', 'Profile has been updated');
    }

    public function allAdmin() {
        $employees = User::where('is_admin',1)->get();
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
            $token   = Str::random(20);
            $employee = User::create([
                'name'        => $request->name,
                'email'       => $request->email,
                'phone'       => $request->phone,
                'password'    => bcrypt($token),
                'token'    => $token,
                'image'       => $profile_image_image_url,
                'is_admin'    => 1,
            ]);
            // Mail::send('password_mail', ['password' => $random, 'email' => $request->email], function ($message) use ($request) {
            //     $message->to($request->email);
            //     $message->subject('Greetings');
            // });

            $maildata = [
                'title'   => 'Geetings from Bhorer Kagoj Prokashan',
                'message' => 'You are invited to use Bhorer Kagoj Prokashan. You can now register here for free',
                'url'     => route('send.email', [$token]),
            ];
            Mail::to($request->email)->send(new SendMail($maildata));


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

    public function registerNewAdmin($token) {
        // dd($token);
        $user = User::where('token', $token)->first();
        if ($user) {
            if ($user->is_verified == 0) {
                return view('admin.admin-management.admin_register', compact('user'));
            } else {
                abort('404');
            }
        } else {
            abort('404');
        }

    }

    
    public function userSignUp(AdminStoreRequest $request) {
        $user  = User::where('email', $request->email)->first();
        // $photo = $request->image;
        // if ($photo) {
        //     $path    = 'avatar/';
        //     $img_url = storeImage($photo, $path, 200, 200);
        // }
        $user->update($request->validated() + [
            'token'       => null,
            // 'image'       => $img_url,
            'is_verified' => 1,
        ]);
        if ($user) {
            Auth::login($user);
            if (Auth::user()->is_super_admin == 1 || Auth::user()->is_admin == 1 ) {
                return redirect()->route('dashboard');
            } else {
                Auth::logout();
                return redirect()->back()->withErrors(['error' => 'Sorry! You have no permission to access this']);
            }

        }
    }
}
