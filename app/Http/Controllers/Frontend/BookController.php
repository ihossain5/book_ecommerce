<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function bookDetails(Book $book)
    {
        $book->load('categories','authors','featureAttributes','authors.books');
        
        $books = [];
        foreach($book->authors as $author ){
            foreach($author->books->where('book_id','!=', $book->book_id) as $author_book){
                $books [] = $author_book;
            }
        }

        $related_books = collect($books)->unique('book_id');

       return view('frontend.book.book_details',compact('book','related_books'));
    }

}
