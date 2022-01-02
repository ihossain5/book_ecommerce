<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Service\BookService;
use App\Service\HomepageService;

class HomePageController extends Controller {
    public function index(HomepageService $homepageService) {
        $books = $homepageService->latestBook();

        $featureCategories = $homepageService->featureCategories();

        return view('frontend.index',compact('books', 'featureCategories'));
    }
}
