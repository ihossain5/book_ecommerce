<?php
namespace App\Service;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;

Class HomepageService {

    function latestBook() {
        return Book::with('authors', 'publication', 'reviews')->where('is_visible', 1)->latest()->limit(8)->get();
    }

    function featureCategories() {
        return Category::where('is_home', 1)->orderBy('precedance', 'ASC')->limit(4)->get();
    }

    function authors() {
        return Author::latest()->limit(12)->get();
    }

    function popularBooks() {
        return Book::where('is_visible', 1)->with('authors', 'publication', 'reviews', 'orders')->withCount([
            'orders as counted_order' => function ($query) {
                $query->where('order_status_id', 3);
            }])->orderBy('counted_order', 'DESC')->paginate(12);

        // $countedBooks = [];

        // foreach ($books as $book) {
        //     if ($book->counted_order > 0) {
        //         $countedBooks[] = $book;
        //     }
        // }
        // $data = collect($countedBooks);

        // return $data;
    }

}