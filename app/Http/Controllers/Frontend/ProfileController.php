<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        if (Auth::check()) {
            $user_info = Auth::user();
            $id=$user_info->id;
            $user_orders=Order::where('user_id',$id)->latest()->get();
            return view('frontend.profile.my_profile', compact('user_info','user_orders'));
       } else {
            return redirect()->route('frontend.login');
       }
        
       
    }
   
    public function profile_order_view(Request $request) {

        //dd($request->all());
        //dd($id);
        $user_info = Auth::user();
        $id=$user_info->id;
        $user_orders=Order::with('books','order_status','user','paymentMethod')->where('user_id',$id)->where('order_id',$request->id)->first();
        
        //dd( $user_orders);
        return response()->json([
            'success' => true,
            'data'    => $user_orders,
        ]);

    }
   
    
    public function photoUpdate(Request $request){
        if (Auth::check()) {
            $this->validate($request,[
                'photo'=>'required|max:300|image|mimes:png,jpg,jpeg',
             ]);
            $customer = Auth::user();
            if ($request->photo) {
                deleteImage($customer->image);
                $photo     = $request->photo;
                $path      = 'customer/avatar/';
                $photo_url = storeImage($photo, $path, 100, 100);
                $customer->update([
                    'image' => $photo_url,
                ]);
                $data['message'] = 'Profile photo has been updated';

                return $this->success($data);

            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Please upload a photo',
                ]);
            }
        } else {
            Session::flash('error', 'Please sign in to continue');
            return view('frontend.profile.my_profile');
        }
    }


    public function address_details($id) {
       
        $address_info=Address::where('address_id',$id)->first();
        return response()->json($address_info);
    }
    
    public function address_update(Request $request) {
       
        //dd($request->all());
        $validator = Validator::make($request->all(), [

            'modal_name'       => 'required|max:100',
            'modal_phone'       => 'required|max:11',
            'modal_division'       => 'required|max:50',
            'modal_district'       => 'required|max:50',
            'modal_address'       => 'required|max:500',
            'isInsideDhaka'       => 'required|integer',
            'address_id'       => 'required',
        ]);
        if ($validator->fails()) {
            $data          = array();
            $data['error'] = $validator->errors()->all();
            return response()->json([
                'success' => false,
                'data'    => $data,
            ]);
        } else {
           
        
            
            $address = Address::with('user_address')->find($request->address_id);

            $is_default=0;
            foreach($address->user_address as $Address_pivot){
                $is_default=$Address_pivot->pivot->is_default;
            }
        
            $address['name']       = $request->modal_name;
            $address['mobile']       = $request->modal_phone;
            $address['division']       = $request->modal_division;
            $address['district']       = $request->modal_district;
            $address['address']       = $request->modal_address;
            $address['inside_dhaka_city']       = $request->isInsideDhaka;
           
            $address->update();

            $data                   = array();
            $data['message']        = 'Address Updated successfully';
            $data['name']          = $address->name;
            $data['mobile']          = $address->mobile;
            $data['division']=$address->division;
            $data['district']       = $address->district;
            $data['address']       = $address->address;
            $data['inside_dhaka_city']       = $address->inside_dhaka_city;
            $data['is_default']       = $is_default;

            $data['id']          = $request->address_id;

            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        }
    }


    
    
    public function primary_address(Request $request) {
       
        $user_info = Auth::user();
        $id=$user_info->id;
        
        $address_infos=UserAddress::where('user_id',$id)->get();

        foreach($address_infos as $address_info){
            $address_info['is_default']  = 0;
            $address_info->update();
        }

        
        $user_addrress=UserAddress::where('address_id',$request->id)->first();
        //dd($user_addrress);
        $user_addrress['is_default']  = 1;
        $user_addrress->update();

        $addresses=User::with('addresses')->where('id',$id)->first();

        $data = array();
        $data['message'] = 'Primary address successfully checked';
        

        return response()->json([
            'success' => true,
            'data'    => $data,
            'user_address'    => $addresses,
        ]);
    }
    
    
    public function add_address(Request $request) {
       
       //dd($request->all())
        $validator = Validator::make($request->all(), [
            'modal_new_name'   => 'required|max:100',
            'modal_new_phone'   => 'required|max:11',
            'modal_new_division'   => 'required|max:100',
            'modal_new_district'   => 'required|max:100',
            'modal_new_address'   => 'required|max:500',
            'is_inside_dhaka'=>'required|max:200',
        ]);

        if ($validator->fails()) {
            $data          = array();
            $data['error'] = $validator->errors()->all();
            return response()->json([
                'success' => false,
                'data'    => $data,
            ]);
        }else {
        $address = Address::create([
            'name' => $request->modal_new_name,
            'mobile' => $request->modal_new_phone,
            'division' => $request->modal_new_division,
            'district' => $request->modal_new_district,
            'address' => $request->modal_new_address,
            'inside_dhaka_city' => $request->is_inside_dhaka,

        ]);

        $user_info = Auth::user();
        $id=$user_info->id;

        $isExist=UserAddress::where("user_id",$id)->where("is_default",1)->doesntExist();
        //dd($isExist);

        $is_default_add=1;
        if (!$isExist) {
            $is_default_add=0;
        }

        $address->user_address()->attach($id,array('is_default' => $is_default_add));

        $data = array();
        $data['message'] = 'Address Added Successfully';
        
        

        return response()->json([
            'success' => true,
            'data'    => $data,
            'address'=>$address,
            'is_default'=>$is_default_add,
        ]);
        
        }
    
    }

    public function update(Request $request) {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name'  => 'required|max:100',
            'phone' => 'max:2000',
            'dob'   => 'max:100',
            'email' => 'required|max:100',

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
            $user_id   = $user_info->id;
            $user      = User::find($user_id);


            $user['name']          = $request->name;
            $user['phone']         = $request->phone;
            $user['date_of_birth'] = $request->dob;
            $user['email']         = $request->email;
            $user->update();

            $data            = array();
            $data['message'] = 'Profile Updated successfully';
            $data['name']    = $user->name;
            $data['phone']   = $user->phone;
            $data['dob']     = $user->dob;
            $data['email']   = $user->email;
            $data['id']      = $user_id;

            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        }
    }

    public function destroy(Request $request)
    {
        //dd($request->all());
        $address = Address::findOrFail($request->id);

        $user_address=UserAddress::where('user_address_id',$request->id)->first();
        $is_default=$user_address->is_default;
    
        if ($is_default==0) {
            $address->delete();

            $data            = array();
            $data['message'] = 'Address deleted successfully';
            $data['id']      = $request->id;
            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        } else {
            $data            = array();
            $data['message'] = 'You can not deleted Primary Address!';
            return response()->json([
                'success' => false,
                'data'    => $data,
            ]);
        }
    }

    
}
