<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::where('is_admin',0)->get();
        //dd($user_orders);
        return view('admin.customer.customers',compact('users'));
    }
    public function order_review($id)
    {
        $user_orders=Order::where('user_id',$id)->get();
        $user_info=User::where('id',$id)->first();
        $user_name=$user_info->name;


        //dd($user_orders);
        return view('admin.customer.customer_order_info',compact('user_orders','user_name'));
    }

    public function customer_info(Request $request)
    {
        $user_info=User::where('id',$request->id)->first();
        //$user_name=$user_info->name;  
        // dd($user_info);

        $data['id'] = $request->id;


        return response()->json([
            'success' => true,
            'data'    => $user_info,
        ]);
    }

    public function user_ban(Request $request)
    {
        //dd($request->all());

        $validator = Validator::make(
            $request->all(),
            [
                'user_id'    => 'required',
            ]

        );

        if ($validator->fails()) {
            $data          = array();
            $data['error'] = $validator->errors()->all();
            return response()->json([
                'success' => false,
                'data'    => $data,
            ]);
        } else {

            $user_id = $request->user_id;

            $is_ban= User::find($user_id);

            if ($is_ban->ban == 1) {

                $is_ban['ban'] = 0;
                $is_ban->update();
                $data                   = array();
                $data['message']        = 'User Unblocked';

                $data['status']        = $is_ban->ban;
                $data['id']          = $request->user_id;

                return response()->json([
                    'success' => true,
                    'data'    => $data,
                ]);
                
            } else {

                $is_ban['ban'] = 1;

                $is_ban->update();

                $data['message']        = 'User Blocked';
                $data['status']        = $is_ban->ban;
                $data['id']          = $request->user_id;


                return response()->json([
                    'success' => false,
                    'data'    => $data,
                ]);
            }

        }
    }

}
