<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publication;
use App\Service\HomepageService;

class HomePageController extends Controller {
    public function index(HomepageService $homepageService) {
        $books = $homepageService->latestBook();

        $featureCategories = $homepageService->featureCategories();

        $authors = $homepageService->authors();

        $popularBooks = $homepageService->popularBooks();

        return view('frontend.index', compact('books', 'featureCategories','authors','popularBooks'));
    }

    public static function all_authors() {
        return Author::all();

    }

    public static function all_category() {
        return Category::all();

    }

    public static function all_publication() {
        return Publication::all();

    }
}
