<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use PDF;

class OrderController extends Controller
{
    public function index(){

        $orders = Order::all();

        return view('admin.orders.order_management',compact('orders'));
    }

    public function downloadInvoice(Order $order){

        $order->load('paymentMethod','status','user');

        $pdf        = PDF::loadView('admin.orders.order_invoice', [
            'order'       => $order,
        ],[], [
            'default_font' => 'nikosh',
        ]);

        return $pdf->download('invoice.pdf');
    }
}
