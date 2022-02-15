<?php

namespace App\Providers;

use App\View\Composers\CartComposer;
use App\View\Composers\DiscountModalComposer;
use App\View\Composers\SliderComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        View::composer(['partial.frontend.cart'], CartComposer::class);
        View::composer(['frontend.book.cart'], CartComposer::class);
        View::composer(['partial.frontend.banner_slider'], SliderComposer::class);
        View::composer(['partial.frontend.discountModal'], DiscountModalComposer::class);
    }
}
