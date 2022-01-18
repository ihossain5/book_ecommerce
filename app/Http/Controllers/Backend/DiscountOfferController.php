<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DiscountOffer;
use Illuminate\Http\Request;

class DiscountOfferController extends Controller {
    public function index() {

        $discount_offer = DiscountOffer::first();

        return view('admin.offers.discount_offer_management', compact('discount_offer'));
    }

    public function edit(DiscountOffer $discountOffer) {

        return $this->success($discountOffer);
    }
    public function update(DiscountOffer $discountOffer, Request $request) {
        // dd($request->all());
        $photo = $request->image;

        if ($photo) {
            deleteImage($discountOffer->image);
            $photo_url = $this->uploadPhoto($photo);
        } else {
            $photo_url = $discountOffer->image;
        }

        $discountOffer->update(['image'=>$photo_url]);

        $discountOffer->message = 'Data updated successfully';

        return $this->success($discountOffer);
    }

    function uploadPhoto($photo) {
        $path = 'discount-offfer/';

        $photo_url = storeImage($photo, $path, 277, 369);

        return $photo_url;
    }

    public function updateStatus(Request $request){
        $discountOffer = DiscountOffer::findOrFail($request->id);

        if ($discountOffer->is_visible == 0) {
            $discountOffer->update([
                'is_visible' => 1,
            ]);
        } else {
            $discountOffer->update([
                'is_visible' => 0,
            ]);
        }

        $discountOffer->message = 'Status changed successfully';

        return $this->success($discountOffer);
    }
}
