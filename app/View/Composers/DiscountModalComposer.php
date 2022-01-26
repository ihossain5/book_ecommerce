<?php

namespace App\View\Composers;

use App\Models\DiscountOffer;
use App\Service\CartService as ServiceCartService;
use App\Service\SliderService;
use Illuminate\View\View;

class DiscountModalComposer extends SliderService {

    public function compose(View $view) {
        $view->with([
            'discountOffer' => DiscountOffer::first(),
        ]);
    }

}