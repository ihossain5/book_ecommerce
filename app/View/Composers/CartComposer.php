<?php

namespace App\View\Composers;

use App\Service\CartService as ServiceCartService;
use Illuminate\View\View;

class CartComposer extends ServiceCartService {

    public function compose(View $view) {
        $view->with([
            'totalAmount' => $this->subTotal(),
            'items'       => $this->getCartContent(),
            'cartQty'       => $this->numberOfCartQty(),
        ]);
    }

}