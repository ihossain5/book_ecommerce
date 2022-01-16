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
            foreach($author->books->where('book_id','!=', $book->book_id)->where('is_visible',1) as $author_book){
                $books [] = $author_book;
            }
        }

        $related_books = collect($books)->unique('book_id');

        $url = route('frontend.book.details',$book->book_id);

        $shareComponent = \Share::page(
            $url
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->whatsapp();       
    

        if(count($book->reviews)>0){
            $rating = $this->getTotalRating($book->reviews);
        }else{
            $rating = 0;
        }

       return view('frontend.book.book_details',compact('book','related_books','rating','shareComponent'));
    }

    private function getTotalRating($reviews) {
        $totalReviews = $reviews->count();
        $totalSum     = $reviews->sum('rating');

        return round($totalSum / $totalReviews,1);
    }


    public function index()
    {
        $books=Book::with('authors')->where('is_visible',1)->paginate(12);

        $authors=Author::orderBy('name')->get();
        $categories=Category::orderBy('name')->get();
        $publications=Publication::orderBy('name')->get();
        //dd( $books);
        return view('frontend.book.books',compact('books','authors','categories','publications'));
    }

}
