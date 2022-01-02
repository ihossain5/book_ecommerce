<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publication;
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

        if(count($book->reviews)>0){
            $rating = $this->getTotalRating($book->reviews);
        }else{
            $rating = 0;
        }

        
       

        // dd($rating);


       return view('frontend.book.book_details',compact('book','related_books','rating'));
    }

    private function getTotalRating($reviews) {
        $totalReviews = $reviews->count();
        $totalSum     = $reviews->sum('rating');

        return round($totalSum / $totalReviews,1);
    }


    public function index()
    {
        
        $books=Book::with('authors')->get();

        $authors=Author::orderBy('name')->get();
        $categories=Category::orderBy('name')->get();
        $publications=Publication::orderBy('name')->get();
        //dd( $books);
        return view('frontend.book.books',compact('books','authors','categories','publications'));
    }

}
