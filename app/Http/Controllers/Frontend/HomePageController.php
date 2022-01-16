<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publication;
use App\Service\HomepageService;
use App\Models\SocialMedia;

class HomePageController extends Controller {
    public function index(HomepageService $homepageService) {
        $books = $homepageService->latestBook();

        $featureCategories = $homepageService->featureCategories();

        $authors = $homepageService->authors();

        $popularBooks = $homepageService->popularBooks();

        // dd($popularBooks);

        return view('frontend.index', compact('books', 'featureCategories','authors','popularBooks'));
    }

    public static function all_authors() {
        return Author::all();

    }

    public static function all_category() {
        return Category::where('is_nav',1)->get();

    }

    public static function all_publication() {
        return Publication::all();

    }
    public static function footer() {
        return SocialMedia::all();

    }
}
