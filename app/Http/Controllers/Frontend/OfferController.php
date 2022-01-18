<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Offer;

class OfferController extends Controller {
    public function offerBooks(Offer $offer) {
        

        if ($offer->is_visible != 1) {
            abort('404');
        }

        $title = $offer->title;

        $offer->load('books', 'books.authors');

        $books = $offer->books;

        return view('frontend.book.offer_books', compact('offer','books','title'));
    }
}
