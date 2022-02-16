<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Publication;
use App\Service\HomepageService;
use Illuminate\Http\Request;

class BookController extends Controller {
    public function bookDetails(Book $book) {
        $book->load('categories', 'authors', 'featureAttributes', 'authors.books');

        $books = [];
        foreach ($book->authors as $author) {
            foreach ($author->books->where('book_id', '!=', $book->book_id)->where('is_visible', 1) as $author_book) {
                $books[] = $author_book;
            }
        }

        $related_books = collect($books)->unique('book_id');

        $url = route('frontend.book.details', $book->book_id);

        $shareComponent = \Share::page(
            $url
        )
            ->facebook()
            ->twitter()
            ->linkedin()
            ->whatsapp();

        if (count($book->reviews) > 0) {
            $rating = $this->getTotalRating($book->reviews);
        } else {
            $rating = 0;
        }

        return view('frontend.book.book_details', compact('book', 'related_books', 'rating', 'shareComponent'));
    }

    private function getTotalRating($reviews) {
        $totalReviews = $reviews->count();
        $totalSum     = $reviews->sum('rating');

        return round($totalSum / $totalReviews, 1);
    }

    public function index() {
        $books = Book::with('authors')->where('is_visible', 1)->paginate(12);

        $authors      = Author::orderBy('name')->get();
        $categories   = Category::orderBy('name')->get();
        $publications = Publication::orderBy('name')->get();
        //dd( $books);
        return view('frontend.book.books', compact('books', 'authors', 'categories', 'publications'));
    }

    public function getPopularBooks(HomepageService $homepageService) {

        $books = $homepageService->popularBooks();

        $offer_id = null;

        $title = 'সর্বাধিক বিক্রিত বই';

        $authors = Author::orderBy('name')->get();

        $categories = Category::orderBy('name')->get();

        $publications = Publication::orderBy('name')->get();

        return view('frontend.book.popular_books', compact('books', 'title', 'offer_id', 'authors', 'categories', 'publications'));

    }

    public function filterBookByPrice(Request $request) {
        // dd($request->all());
        $min_price = $request->minValue;

        $max_price = $request->maxValue;

        $books = [];

        if ($request->popularBook == true) {
            $books = Book::where('is_visible', 1)->whereBetween('discounted_price', [$min_price, $max_price])->with('authors', 'publication', 'reviews', 'orders')->withCount([
                'orders as counted_order' => function ($query) {
                    $query->where('order_status_id', 4);
                }])->orderBy('counted_order', 'DESC')->get();

        } else if ($request->offer_id != null) {
            $offer = Offer::with(['books.authors','books' => function ($q) use ($min_price, $max_price) {
                $q->where('is_visible', 1)->whereBetween('discounted_price', [$min_price, $max_price])->get();
            }])->findOrFail($request->offer_id);

            $books = $offer->books;

        } else if ($request->category_id != null) {
            $category = Category::with(['books.authors','books' => function ($q) use ($min_price, $max_price) {
                $q->where('is_visible', 1)->whereBetween('discounted_price', [$min_price, $max_price])->get();
            }])->findOrFail($request->category_id);

            $books = $category->books;

        } else if ($request->author_id != null) {
            $author = Author::with(['books.authors','books' => function ($q) use ($min_price, $max_price) {
                $q->where('is_visible', 1)->whereBetween('discounted_price', [$min_price, $max_price])->get();
            }])->findOrFail($request->author_id);

            $books = $author->books;

        } else if ($request->books == true) {
            $books = Book::where('is_visible', 1)->whereBetween('discounted_price', [$min_price, $max_price])->with('authors')->get();

        } else if($request->publication_id != null){
            $publication = Publication::with(['books.authors','books' => function ($q) use ($min_price, $max_price) {
                $q->where('is_visible', 1)->whereBetween('discounted_price', [$min_price, $max_price])->get();
            }])->findOrFail($request->publication_id);

            $books = $publication->books;
        }
        else {
            $books = [];
        }
        return $this->success($books);

    }

}
