<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Whislist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function store(Request $request) {
        $data = [];

        $wishlistExits = Whislist::where('user_id',auth()->user()->id)->where('book_id',$request->id)->first();

        if($wishlistExits){

            $data['message'] = 'This book is already in your wishlist';

        }else{

            $data = Whislist::create([
                'book_id' => $request->id,
                'user_id' => auth()->user()->id,
            ]);

            $data['message'] = 'This book is added to your wishlist';
        }

        $data['whislist'] = auth()->user()->wishlists->count();

        return $this->success($data);

    }
}
