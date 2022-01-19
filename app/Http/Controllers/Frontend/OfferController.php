<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publication;

class OfferController extends Controller
{
    public function offerBooks(Offer $offer)
    {


        if ($offer->is_visible != 1) {
            abort('404');
        }

        $title = $offer->title;

        $offer->load('books', 'books.authors');

        $books = $offer->books()->paginate(12);

        $offer_id = $offer->offer_id;
        $authors = Author::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $publications = Publication::orderBy('name')->get();
        //dd($books);
        return view('frontend.book.offer_books', compact('offer', 'books', 'title', 'offer_id', 'authors', 'categories', 'publications'));
        // return view('frontend.book.offer_books', compact('offer', 'books', 'title'));
    }
}
