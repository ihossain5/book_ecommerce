<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function bookDetails(Book $book)
    {
        $book->load('categories','authors','featureAttributes');

       return view('frontend.book.book_details',compact('book'));
    }
}
