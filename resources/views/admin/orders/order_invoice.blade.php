<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png" />
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,600;1,700&display=swap"
        rel="stylesheet">
    <title>Bhorer kagoj </title>
    <style>
        body,
        td,
        input,
        textarea,
        select {
            margin: 0;
        }
    </style>
</head>

<body style="margin: 0; ">

    <table align="center" border="0" cellpadding='0' cellspacing="0"
        style="max-width: 650px; width: 100%;  border-spacing: 0; background-color: #ffffff;">
        <tbody>
            <tr>
                <td>
                    <table style="width: 100%; border-spacing: 0;">
                        <tbody>
                            <tr>
                                <td colspan="5" style="height: 16px;"></td>
                            </tr>
                            <!-- logo -->
                            <tr>
                                <td style="width: 100%;">
                                    <table style="width: 100%; border-spacing: 0;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 10%"></td>
                                                <td style="width: 27%"></td>
                                                <td style="width: 26%">
                                                    {{-- <img src="{{public_path('images/logo.png')}}" alt="logo" style="width: 170px"> --}}
                                                    <img src="{{url('images/logo.png')}}" alt="logo" style="width: 170px">
                                                </td>
                                                <td style="width: 27%"></td>
                                                <td style="width: 10%"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- empty space -->
                            <tr>
                                <td colspan="5" style="height: 25px;"></td>
                            </tr>
                            <!-- Address -->
                            <tr>
                                <td style="width: 100%;">
                                    <table style="width: 100%; border-spacing: 0;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 30%"></td>
                                                <td style="width: 40%">
                                                   {{$appInfo->address}}
                                                </td>
                                                <td style="width: 30%"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- empty space -->
                            <tr>
                                <td colspan="5" style="height: 25px;"></td>
                            </tr>
                            <!-- heading status -->
                            <tr>
                                <td style="width: 100%">
                                    <table style="width: 100%; border-spacing: 0;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 8%"></td>
                                                <td style="width: 30%; font-weight:800;">
                                                    <h1 style="margin: 0; font-size: 18px; font-family:nikosh; font-weight: 800; ">{{$appInfo->name}}</h1>
                                                </td>
                                                <td style="width: 30%; font-weight:600;">
                                                    <h1 style="margin: 0; font-size: 12px; font-family: 'Jost', sans-serif; ">Order ID: #{{$order->id}}</h1>
                                                </td>
                                                <td style="width: 30%; font-weight:600;">
                                                    <h1 style="margin: 0; font-size: 12px; font-family: 'Jost', sans-serif; ">Order Date: {{formatDate($order->created_at)}}
                                                    </h1>
                                                </td>
                                                <td style="width: 7%"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- empty space -->
                            <tr>
                                <td colspan="5" style="height: 20px"></td>
                            </tr>
                            <!-- head title -->
                            <tr>
                                <td style="width: 100%">
                                    <table style="width: 100%; border-spacing: 0;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 10%"></td>
                                                <td style="width: 30%"></td>
                                                <td
                                                    style="width: 20%; background-color: #15A99F;  padding-top: 6px; padding-bottom: 6px; text-align: center;">
                                                    <h1
                                                        style="margin: 0; font-size: 18px; font-weight: 700; color: #fff; ">
                                                        Order Details</h1>
                                                </td>
                                                <td style="width: 30%"></td>
                                                <td style="width: 10%"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- empty space -->
                            <tr>
                                <td colspan="5" style="height: 25px"></td>
                            </tr>
                            <!-- billing details -->
                            <tr>
                                <td style="width: 100%">
                                    <table style="width: 100%; border-spacing: 0;">
                                        <tbody>

                                            <tr>
                                                <td style="width: 6%"></td>
                                                <td width="53%" style="vertical-align: top;">
                                                    <table style="width: 100%; border-spacing: 0;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 100%;">
                                                                    <h1
                                                                        style="margin: 0;font-family: 'Jost', sans-serif; font-size: 16px; font-weight: 600;">
                                                                        Shipping Address</h1>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 100%; height: 15px;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 100%; line-height: 22px; font-family:nikosh;">
                                                                    <!--new added start   -->
                                                                    <p
                                                                        style="margin: 0; font-family:nikosh; font-size: 16px; line-height: 19px; font-weight: 500; width: 200px;">
                                                            <!--new added end   -->

                                                            {{$order->division}}, {{$order->district}}, {{$order->address}}</p>
                                                                </td>
                                                            </tr>

                                                            <!--new added start   -->
                                                            <tr>
                                                                <td style="width: 100%; height: 15px;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 100%; height: 15px;"></td>
                                                            </tr>
                                                            <!--new added end   -->
                                                            <tr>
                                                                <td style="width: 100%;">
                                                                    <!--new added start   -->
                                                                    <p
                                                                        style="margin: 0;font-family: 'Jost', sans-serif; font-size: 12px; line-height: 24px; font-weight: 500;">
                                                                        Name: <span style="font-weight: 700; font-family:nikosh;">{{$order->name}}</span> </p>
                                                            <!--new added end   -->

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 100%; line-height: 22px;">
                                                                    <!--new added start   -->
                                                                    <p
                                                                        style="margin: 0;font-family: 'Jost', sans-serif; font-size: 12px; line-height: 24px; font-weight: 500;">
                                                                        Phone: <span style="font-weight: 700;">{{$order->phone}}</span></p>
                                                            <!--new added end   -->

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 100%; line-height: 22px;">
                                                                    <!--new added start   -->
                                                                    <p
                                                                        style="margin: 0;font-family: 'Jost', sans-serif; font-size: 12px; line-height: 24px; font-weight: 500;">
                                                                        Email: <span style="font-weight: 700;">{{$order->email}}</span></p>
                                                                        <!--new added start   -->

                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td style="width: 37%">
                                                    <!--new added start   -->
                                                    <table style="width: 100%; border-spacing: 0;">
                                                        <tbody>
                                                            <tr><td style="width: 100%; height: 17px;"></td></tr>
                                                            <tr><td style="width: 100%; height: 17px;"></td></tr>
                                                            <tr><td style="width: 100%; height: 17px;"></td></tr>
                                                            <tr><td style="width: 100%; height: 17px;"></td></tr>
                                                            <tr><td style="width: 100%; height: 17px;"></td></tr>
                                                            <tr><td style="width: 100%; height: 17px;"></td></tr>
                                                            <tr><td style="width: 100%; height: 17px;"></td></tr>
                                                            <tr><td style="width: 100%; height: 17px;"></td></tr>
                                                            <tr><td style="width: 100%; height: 17px;"></td></tr>
                                                            <tr>
                                                                <td>
                                                                    <p
                                                                    style="margin: 0; font-family: 'Jost', sans-serif; font-size: 12px;
                                                                    line-height: 24px; font-weight: 500;">
                                                                    Delivary Method: <span style="font-weight: 700; font-family:nikosh; font-size: 16px;">{{$order->paymentMethod->payment_method}}</span>
                                                                    </p>
                                                                </td>
                                                                
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!--new added start   -->
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- table head -->
                            <tr>
                                <td style="width: 100%;">
                                    <table style="width: 100%; border-spacing: 0;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 10%"></td>
                                                <td style="width: 29%"></td>
                                                <td style="width: 22%;  font-family: 'Jost', sans-serif; font-weight: 700; padding-top:12px;">
                                                    <h1
                                                        style="margin: 0; font-family: 'Jost', sans-serif; font-size: 14px; font-style: italic; border-bottom: 1px solid #000; text-align: center;">
                                                        Purchase Summery</h1>

                                                </td>
                                                <td style="width: 29%"></td>
                                                <td style="width: 10%"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- empty space -->
                            <tr>
                                <td colspan="5" style="height: 12px;"></td>
                            </tr>
                            <!-- table -->
                            <tr>
                                <td style="width: 100%">
                                    <table style="width: 100%; border-spacing: 0;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 6%;"></td>
                                                <td style="width: 88%;">
                                                    <table
                                                        style="width: 100%; border-spacing: 0; border-style: solid; border-color: #000; border-width: 1px 1px 0 1px;">
                                                        <tr style="border-bottom: 1px solid #000;">
                                                            <td
                                                                style="width: 4%; text-align: center;border-bottom: 1px solid #000; font-weight: bold;">
                                                                <p style="margin: 0; font-size: 11px;">SL</p>
                                                            </td>
                                                            <td
                                                                style="width: 10%; border-style: solid; font-weight: bold; border-color: #000; border-width: 0 1px 1px 1px; text-align: center;">
                                                                <p style="margin: 0; font-size: 11px; ">Image</p>
                                                            </td>
                                                            <td
                                                                style="width: 25%; text-align: center;border-bottom: 1px solid #000; font-weight: bold;">
                                                                <p style="margin: 0; font-size: 11px; ">Name and
                                                                    Description</p>
                                                            </td>
                                                            <td
                                                                style="width: 10%; border-style: solid;  font-weight: bold; border-color: #000; border-width: 0 1px 1px 1px; text-align: center;">
                                                                <p style="margin: 0; font-size: 11px; ">Quantity</p>
                                                            </td>
                                                            <td
                                                                style="width: 10%; text-align: center;border-bottom: 1px solid #000; font-weight: bold;">
                                                                <p style="margin: 0; font-size: 11px; ">Price</p>
                                                            </td>
                                                            <td
                                                                style="width: 10%; border-style: solid; border-color: #000; border-width: 0 0 1px 1px; text-align: center; font-weight: bold;">
                                                                <p style="margin: 0; font-size: 11px; ">Total</p>
                                                            </td>
                                                        </tr>

                                                        @if (!empty($order->books))
                                                        @foreach ($order->books as $book)
                                                        <tr style="border-bottom: 1px solid #000;">
                                                            <td
                                                                style="width: 4%; text-align: center;border-bottom: 1px solid #000;">
                                                                <p
                                                                    style="margin: 0; font-size: 12px; font-weight: 400;">
                                                                    {{$loop->iteration}}</p>
                                                            </td>
                                                            <td
                                                                style="width: 10%; border-style: solid; border-color: #000; border-width: 0 1px 1px 1px; text-align: center;">

                                                                {{-- <img style="width: 46px; height: 46px;" src="{{public_path('images/'.$book->cover_image)}}"
                                                                    alt=""> --}}
                                                                <img style="width: 46px; height: 46px;" src="{{url('images/'.$book->cover_image)}}"
                                                                    alt="">

                                                            </td>
                                                            <td
                                                                style="width: 25%; text-align: center;border-bottom: 1px solid #000; font-family:nikosh;">
                                                                <p
                                                                    style="margin: 0; font-size: 12px; font-weight: 400;">
                                                                    {{$book->title}}</p>
                                                            </td>

                                                            <td
                                                                style="width: 10%; border-style: solid; border-color: #000; border-width: 0 1px 1px 1px; text-align: center;">
                                                                <p
                                                                    style="margin: 0; font-size: 12px; font-weight: 400;">
                                                                    {{$book->pivot->quantity}}</p>
                                                            </td>
                                                            <td
                                                                style="width: 10%; text-align: center;border-bottom: 1px solid #000;">
                                                                <p
                                                                    style="margin: 0; font-size: 12px; font-weight: 400;">
                                                                    <span
                                                                        style="font-family: nikosh; font-size: 14px;">৳</span>
                                                                        {{$book->discounted_price}}
                                                                </p>
                                                            </td>
                                                            <td
                                                                style="width: 10%; border-style: solid; border-color: #000; border-width: 0 0 1px 1px; text-align: center;">
                                                                <p
                                                                    style="margin: 0; font-size: 12px; font-weight: 400;">
                                                                    <span
                                                                        style="font-family: nikosh; font-size: 14px;">৳</span>
                                                                        {{$book->pivot->amount}}
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endif                                           

                                                    </table>
                                                </td>
                                                <td style="width: 6%;"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- empty space -->
                            <tr>
                                <td colspan="5" style="height: 12px;"></td>
                            </tr>
                            <!-- sub total box -->
                            <tr>
                                <td style="width: 100%">
                                    <table style="width: 100%; border-spacing: 0;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 10%"></td>
                                                <td style="width: 45%"></td>
                                                <td style="width: 35%">
                                                    <table style="width: 100%; border-spacing: 0;">
                                                        <tbody>
                                                            <tr>
                                                                <td
                                                                    style="width: 50%; border-style: solid; border-color: #3084bb; border-width: 1px 0 0 0; font-weight: 400; line-height: 28px;">
                                                                    <p style="margin: 0; font-size: 14px; ">Sub-total:
                                                                    </p>
                                                                </td>
                                                                <td
                                                                    style="width: 50%; text-align: right; border-style: solid; border-color: #3084bb; border-width: 1px 0 0 0; line-height: 28px;">
                                                                    <p
                                                                        style="margin: 0; font-size: 14px; font-weight: 400; ">
                                                                        <span
                                                                            style="font-family: nikosh; font-size: 14px;">৳</span>
                                                                        {{currency_format($order->subtotal)}}
                                                                    </p>

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td
                                                                    style="width: 50%; border-style: solid; border-color: #3084bb; border-width: 1px 0 1px 0; font-weight: 400; line-height: 28px;">
                                                                    <p style="margin: 0; font-size: 14px; ">Delivery
                                                                        fee:
                                                                    </p>
                                                                </td>
                                                                <td
                                                                    style="width: 50%; text-align: right; border-style: solid; border-color: #3084bb; border-width: 1px 0 1px 0; line-height: 28px;">
                                                                    <p
                                                                        style="margin: 0; font-size: 14px; font-weight: 400; ">
                                                                        <span
                                                                            style="font-family: nikosh; font-size: 14px;">৳</span>
                                                                            {{currency_format($order->delivery_fee)}}
                                                                    </p>

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td
                                                                    style="width: 50%; border-style: solid; border-color: #3084bb; border-width: 1px 0 1px 0; font-weight: 400; line-height: 28px;">
                                                                    <p style="margin: 0; font-size: 14px; ">Wrapping Cost:
                                                                    </p>
                                                                </td>
                                                                <td
                                                                    style="width: 50%; text-align: right; border-style: solid; border-color: #3084bb; border-width: 1px 0 1px 0; line-height: 28px;">
                                                                    <p
                                                                        style="margin: 0; font-size: 14px; font-weight: 400; ">
                                                                        <span
                                                                            style="font-family: nikosh; font-size: 14px;">৳</span>
                                                                            {{currency_format($order->wrapping_cost)}}
                                                                    </p>

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td
                                                                    style="width: 50%; line-height: 28px; font-weight: bold; ">
                                                                    <p style="margin: 0; font-size: 14px; ">Total Order:
                                                                    </p>
                                                                </td>
                                                                <td
                                                                    style="width: 50%; text-align: right; line-height: 28px;  ">
                                                                    <p style="margin: 0; font-size: 14px;">
                                                                        <span
                                                                            style="font-family: nikosh; font-size: 14px;">৳</span>
                                                                            {{currency_format($order->total)}}
                                                                    </p>

                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td style="width: 10%"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- empty space -->
                            <tr>
                                <td colspan="5" style="height: 24px;"></td>
                            </tr>


                            <!-- empty space -->
                            <tr>
                                <td colspan="5" style="height: 32px;"></td>
                            </tr>


                        </tbody>
                    </table>
                </td>
            </tr>
            <!-- <tr>
                <td style="width: 100%;" align="center" height="50"></td>
            </tr> -->
        </tbody>
    </table>
</body>

</html>
