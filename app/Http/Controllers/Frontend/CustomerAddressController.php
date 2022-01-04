<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class CustomerAddressController extends Controller
{
    public function getAddress(Request $request){
        $address = Address::findOrFail($request->id);

        return $this->success($address);
    }
}
