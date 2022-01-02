<?php

namespace App\View\Composers;

use App\Service\CartService as ServiceCartService;
use App\Service\SliderService;
use Illuminate\View\View;

class SliderComposer extends SliderService {

    public function compose(View $view) {
        $view->with([
            'sliders' => $this->getAllSliders(),
        ]);
    }

}