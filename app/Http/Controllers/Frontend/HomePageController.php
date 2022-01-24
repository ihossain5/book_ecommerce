<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Offer;
use App\Models\Publication;
use App\Service\HomepageService;
use App\Models\SocialMedia;

class HomePageController extends Controller {
    public function index(HomepageService $homepageService) {
        $books = $homepageService->latestBook();

        $featureCategories = $homepageService->featureCategories();

        $authors = $homepageService->authors();

        $popularBooks = $homepageService->popularBooks();

        return view('frontend.index', compact('books', 'featureCategories','authors','popularBooks'));
    }

    public static function all_authors() {
        return Author::orderBy('precedance','ASC')->get();

    }

    public static function all_category() {
        return Category::where('is_nav',1)->orderBy('precedance','ASC')->get();

    }
    public static function offers() {
        return Offer::where('is_visible',1)->get();

    }

    public static function all_publication() {
        return Publication::orderBy('precedance','ASC')->get();

    }
    public static function footer() {
        return SocialMedia::all();
    }

    public static function appInfo() {
        return Contact::first();
    }
}
