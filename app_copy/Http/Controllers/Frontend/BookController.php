<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;

class BookController extends Controller {
    public function bookDetails(Book $book) {
        $book->load('categories', 'authors', 'featureAttributes', 'authors.books', 'reviews', 'reviews.user');

        $books = [];
        foreach ($book->authors as $author) {
            foreach ($author->books->where('book_id', '!=', $book->book_id) as $author_book) {
                $books[] = $author_book;
            }
        }

        $rating = $this->getTotalRating($book->reviews);

        $related_books = collect($books)->unique('book_id');

        return view('frontend.book.book_details', compact('book', 'related_books', 'rating'));
    }

    private function getTotalRating($reviews) {
        $totalReviews = $reviews->count();
        $totalSum     = $reviews->sum('rating');

        return round($totalSum / $totalReviews);
    }

}
