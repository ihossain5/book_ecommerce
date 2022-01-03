<?php
namespace App\Service;

use App\Models\Book;
use App\Models\Category;

Class HomepageService {

    function latestBook() {
        return Book::with('authors', 'publication','reviews')->latest()->limit(8)->get();
    }

    function featureCategories() {
        return Category::where('is_home', 1)->limit(4)->get();
    }

}