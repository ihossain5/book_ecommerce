<?php

namespace App\Http\Controllers;

use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Order;
use App\Service\CartService;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SslCommerzPaymentController extends Controller {

    public function exampleEasyCheckout() {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout() {
        return view('exampleHosted');
    }

    public function payViaAjax(Request $request, CartService $cartService) {
        $dataArray = $request->get('cart_json');

        $data      = json_decode($dataArray, true);


        $grandTotal = $this->totalAmount($cartService->subTotal(), $data['deliveryFee']);

        $data['tran_id'] = uniqid(); // tran_id must be unique

        $data['total_amount'] = floatval(preg_replace('/[^\d.]/', '', $grandTotal)); # You cant not pay less than 10

        $data['currency']     = "BDT";

        # CUSTOMER INFORMATION
        $data['cus_name']     = 'Customer Name';
        $data['cus_email']    = 'customer@mail.com';
        $data['cus_add1']     = 'Customer Address';
        $data['cus_add2']     = "";
        $data['cus_city']     = "";
        $data['cus_state']    = "";
        $data['cus_postcode'] = "";
        $data['cus_country']  = "Bangladesh";
        $data['cus_phone']    = '8801XXXXXXXXX';
        $data['cus_fax']      = "";

        # SHIPMENT INFORMATION
        $data['ship_name']     = "Store Test";
        $data['ship_add1']     = "Dhaka";
        $data['ship_add2']     = "Dhaka";
        $data['ship_city']     = "Dhaka";
        $data['ship_state']    = "Dhaka";
        $data['ship_postcode'] = "1000";
        $data['ship_phone']    = "";
        $data['ship_country']  = "Bangladesh";

        $data['shipping_method']  = "NO";
        $data['product_name']     = "Computer";
        $data['product_category'] = "Goods";
        $data['product_profile']  = "physical-goods";

        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = Order::create([
                'name'            => $data['name'],
                'email'           => $data['email'] ?? null,
                'phone'           => $data['phone'],
                'notes'           => $data['notes'],
                'amount'          => $data['total_amount'],
                'status'          => 'Pending',
                'address'         => $data['address'],
                'total'           => $grandTotal,
                'subtotal'        => floatval(preg_replace('/[^\d.]/', '', $cartService->subTotal())),
                'transaction_id'  => $data['tran_id'],
                'delivery_fee'    => $data['deliveryFee'],
                'division'        => $data['division'],
                'district'        => $data['district'],
                'user_id'         => auth()->user()->id,
                'order_status_id' => 1,
                'id'              => getMaxId(),
            ]);


        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

        foreach ($cartService->getCartContent() as $book) {
            $update_product->books()->attach([$book->id => [
                'quantity' => $book->qty,
                'amount'   => $book->subtotal,
            ]]);
        }

    }



    public function paymentSuccess(Request $request, CartService $cartService) {
        // echo "Transaction is Successful";

        $tran_id  = $request->input('tran_id');
        $amount   = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                 */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);

                $cartService->destroy();

                Session::flash('success', 'Order has been placed');

                return redirect()->route('frontend.home');

            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                 */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);
                echo "validation Fail";
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            /*
            That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            $cartService->destroy();

            Session::flash('success', 'Order has been placed');

            return redirect()->route('frontend.home');

        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }

    }

    public function fail(Request $request) {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request) {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function ipn(Request $request) {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc       = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                     */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                     */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);

                    echo "validation Fail";
                }

            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

    // order total amount
    function totalAmount($amount, $deleiveryFee) {
        $amount       = floatval(preg_replace('/[^\d.]/', '', $amount));
        $deleiveryFee = floatval(preg_replace('/[^\d.]/', '', $deleiveryFee));
        return ($amount + $deleiveryFee);
    }

}
