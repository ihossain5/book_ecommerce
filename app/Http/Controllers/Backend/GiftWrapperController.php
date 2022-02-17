<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\GiftWrapper;
use Illuminate\Http\Request;

class GiftWrapperController extends Controller
{
    public function index(){
        $gift_wrapper = GiftWrapper::first();
        return view('admin.gift-wrapper.gift_wrapper',compact('gift_wrapper'));
    }

    public function edit(GiftWrapper $wrapper){
        return $this->success($wrapper);
    }
    public function update(GiftWrapper $wrapper, Request $request){

        $wrapper->update(['cost'=>$request->cost]);

        $wrapper->message = 'Data updated successfully';

        return $this->success($wrapper);
    }

    public function getGiftWrapper(){
        $gift_wrapper = GiftWrapper::first();

        return $this->success($gift_wrapper);
    }
}
