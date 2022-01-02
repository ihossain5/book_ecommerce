<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewStoreRequest;
use App\Models\BookReview;
use Illuminate\Support\Facades\Session;

class ReviewController extends Controller {
    public function store(ReviewStoreRequest $request) {

        $review = BookReview::create($request->validated());

        $review->load('user');

        Session::flash('success','Your review has been added');

        return $this->success($review);

    }
}
