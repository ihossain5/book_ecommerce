<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\OrderCompleteMail;
use App\Models\Contact;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Traits\SmsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use PDF;

class OrderController extends Controller {
    use SmsTrait;

    public function index() {

        $orders = Order::all();

        return view('admin.orders.order_management', compact('orders'));
    }

    public function downloadInvoice(Order $order) {

        $order->load('books');

        $appInfo = Contact::first();

        // dd($appInfo);

        $pdf = PDF::loadView('admin.orders.order_invoice', [
            'order'   => $order,
            'appInfo' => $appInfo,
        ], [], [
            'default_font' => 'nikosh',
        ]);

        $name = 'invoice-' . $order->id;

        return $pdf->download($name . '.pdf');
    }

    public function order_info() {

        $orders         = Order::with('order_status', 'paymentMethod')->latest()->get();
        $order_statuses = OrderStatus::all();
        //dd($orders);
        return view('admin.orders.order_info', compact('orders', 'order_statuses'));
    }
    public function order_view(Request $request) {

        $all_orders = Order::with('books', 'order_status', 'user', 'paymentMethod')->where('order_id', $request->id)->first();

        //dd($all_orders);
        if ($all_orders) {
            return response()->json([
                'success' => true,
                'data'    => $all_orders,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data'    => 'No information found',
            ]);
        }
    }

    public function order_change_status(Request $request) {

        $validator = Validator::make($request->all(), [
            'status_id' => 'required',
            'order_id'  => 'required',
        ]);
        if ($validator->fails()) {
            $data          = array();
            $data['error'] = $validator->errors()->all();
            return response()->json([
                'success' => false,
                'data'    => $data,
            ]);
        } else {

            $order = Order::with('order_status', 'user')->find($request->order_id);

            $order['order_status_id'] = $request->status_id;
            $order->update();

            if ($request->status_id == 2) {

                $message = 'Your order has been confirmed';

                $this->smsSend($order->phone, $message);
            }

            if ($request->status_id == 4) {
                $order->load('books');

                $appInfo = Contact::first();

                $pdf = PDF::loadView('admin.orders.order_invoice', [
                    'order'   => $order,
                    'appInfo' => $appInfo,
                ], [], [
                    'default_font' => 'nikosh',
                ]);

                $details = [
                    'order'   => $order,
                    'appInfo' => $appInfo,
                ];

                // Mail::send('emails.OrderCompleteMail', $data, function($message)use($data, $pdf) {
                //     $message->to($data["email"])
                //             ->subject($data["title"]);
                //             // ->attachData($pdf->output(), "text.pdf");
                // });

                Mail::to($order->user->email)->send(new OrderCompleteMail($appInfo,$order));
            }

            $status      = OrderStatus::where('order_status_id', $order->order_status_id)->first();
            $status_name = $status->name;

            //dd($order);
            $data              = array();
            $data['message']   = 'Status Updated Successfully';
            $data['status_id'] = $order->order_status_id;

            $data['status_name'] = $status_name;

            $data['id'] = $request->order_id;

            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        }
    }

    public function destroy(Request $request) {
        //dd($request->all());
        $order = Order::where('order_id', $request->id)->first();
        if ($order) {
            $order->delete();

            $data            = array();
            $data['message'] = 'Order deleted successfully';
            $data['id']      = $request->id;
            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        } else {
            $data            = array();
            $data['message'] = 'Order can not deleted!';
            return response()->json([
                'success' => false,
                'data'    => $data,
            ]);
        }
    }
}
