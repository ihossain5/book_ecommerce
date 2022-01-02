<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewStoreRequest;
use App\Models\Book;
use App\Models\BookReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReviewController extends Controller
{
    public function store(ReviewStoreRequest $request) {

        // dd($request->all());

        $review = BookReview::create($request->validated());

        $review->load('user');

        Session::flash('success','Your review has been added');

        return $this->success($review);

    }
}
