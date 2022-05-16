<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookReview;

class BookReviewController extends Controller
{
    public function index() {

        $reviews = BookReview::with('user','reviewbook')->get();
        // dd($reviews);

        return view('admin.review.review-management', compact('reviews'));
    }

    public function destroy(Request $request) {
        $review = BookReview::where('book_review_id', $request->id)->first();
        if ($review) {
            $review->delete();

            $data            = array();
            $data['message'] = 'Review deleted successfully';
            $data['id']      = $request->id;
            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        } else {
            $data            = array();
            $data['message'] = 'Review can not deleted!';
            return response()->json([
                'success' => false,
                'data'    => $data,
            ]);
        }
    }

    public function isactive(Request $request){
        // dd($request->all());
        $reviewed= BookReview::where('book_review_id', $request->id)->first();
        $is_active= $reviewed->is_active;
        // dd($is_active);
        if($is_active==0){
            $review= BookReview::where('book_review_id', $request->id)->update(['is_active' => 1]);
        }else{
            $review= BookReview::where('book_review_id', $request->id)->update(['is_active' => 0]);
        }
        $review = BookReview::where('book_review_id', $request->id)->first();
        // dd($review);
        return response()->json([
            'success' => true,
            'data'    => $review,
        ]);
    }
}
