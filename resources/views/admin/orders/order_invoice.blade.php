<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png"/>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,600;1,700&display=swap" rel="stylesheet">
    <title>NEO Bazaar </title>
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
    
    <table align="center" border="0" cellpadding='0' cellspacing="0" style="max-width: 650px; width: 100%;  border-spacing: 0; background-color: #ffffff;">
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
                                                    {{-- <img src="data:image/png;base64,{{ base64_encode(file_get_contents(url('images/invoice-logo.png'))) }}" alt="logo" style="width: 170px"> --}}
                                                    {{-- <img src="{{url('images/invoice-logo.png') }}" alt="logo" style="width: 170px"> --}}
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
                                <td colspan="5" style="height: 12px;"></td>
                            </tr>
                            <!-- heading status -->
                            <tr>
                                <td style="width: 100%">
                                    <table style="width: 100%; border-spacing: 0;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 8%"></td>
                                                <td  style="width: 30%; font-weight:400;">
                                                    <h1 style="margin: 0; font-size: 14px; ">  জনপ্রিয় বিষয়</h1>
                                                </td>
                                                <td  style="width: 30%; font-weight:700;">
                                                    <h1 style="margin: 0; font-size: 14px;">Order ID: {{ $order->order_id }}</h1>
                                                </td>
                                                <td  style="width: 25%; font-weight:700;">
                                                    <h1 style="margin: 0; font-size: 13px; ">Order Date: {{ $order->created_at }}</h1>
                                                </td>
                                                <td style="width: 7%"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- empty space -->
                            <tr>
                                <td colspan="5" style="height: 12px"></td>
                            </tr>
                            <!-- head title -->
                            <tr>
                                <td style="width: 100%">
                                    <table style="width: 100%; border-spacing: 0;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 10%"></td>
                                                <td style="width: 30%"></td>
                                                <td style="width: 20%; background-color: #94ca52;  padding-top: 6px; padding-bottom: 6px; text-align: center;">
                                                    <h1 style="margin: 0; font-size: 18px; font-weight: 700; color: #fff; ">Order Details</h1>
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
                                <td colspan="5" style="height: 12px"></td>
                            </tr>
                            <!-- billing details -->
                            <tr>
                                <td style="width: 100%">
                                    <table style="width: 100%; border-spacing: 0;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 10%"></td>
                                                <td width="53%" style="vertical-align: top;">
                                                    <table style="width: 100%; border-spacing: 0;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 100%; font-weight: 700;">
                                                                    <h1 style="margin: 0; font-size: 14px; ">Billing Address</h1>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 100%; height: 8px;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 100%;">
                                                                    <p style="margin: 0; font-size: 14px; font-weight: 400;">সংকলন: {{ $order->name }}</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 100%; line-height: 22px;">
                                                                    <p style="margin: 0; font-size: 14px; font-weight: 400;">লেখক Number: #{{ $order->order_id }}</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 100%; line-height: 22px;">
                                                                    <p style="margin: 0; font-size: 14px; font-weight: 400;">Phone: {{ $order->mobile }}</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 100%; line-height: 22px;">
                                                                    <p style="margin: 0; font-size: 14px; font-weight: 400;">Email: {{ $order->mobile  }}</p>
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
                            <!-- table head -->
                            <tr>
                                <td style="width: 100%;">
                                    <table style="width: 100%; border-spacing: 0;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 10%"></td>
                                                <td style="width: 29%"></td>
                                                <td style="width: 22%; font-weight: 700; padding-top:12px;">
                                                    <h1 style="margin: 0; font-family: 'Jost', sans-serif; font-size: 14px; font-style: italic; border-bottom: 1px solid #000; text-align: center;" >Purchase Summery</h1>

                                                    {{-- <h1 style="margin: 0; font-size: 16px; font-weight: 700; font-style: italic; border-bottom: 1px solid #000; text-align: center;" >Purchase Summery</h1> --}}
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
                            <!-- footer -->
                            <tr>
                                <td style="width: 100%">
                                    <table style="width: 100%; border-spacing: 0;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 10%;"></td>
                                                <td style="width: 80%; text-align: center; line-height: 22px; font-weight: bold;">
                                                    <p style="margin: 0; font-size: 11px;  ">Thanks for purchasing from us. Buy post a review of this product in www.neo-bazaar.com</p>
                                                </td>
                                                <td style="width: 10%;"></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 10%;"></td>
                                                <td style="width: 80%; text-align: center; line-height: 22px; font-weight: bold;">
                                                    <p style="margin: 0; font-size: 11px; ">If you face any problem during delivery, Call us at Helpline: +8801859893939</p>
                                                </td>
                                                <td style="width: 10%;"></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 10%;"></td>
                                                <td style="width: 80%; text-align: center; line-height: 22px; font-weight: bold;">
                                                    <p style="margin: 0; font-size: 11px; ">Feel free to contact us customer support at 
                                                        <a style="color: #3084bb; text-decoration: none;" href="matilto:customercare@neo-nazaar.com">customercare@neo-nazaar.com</a>
                                                    </p>
                                                </td>
                                                <td style="width: 10%;"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- follow us -->
                            <tr>
                                <td style="width: 100%">
                                    <table style="width: 100%; border-spacing: 0;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 10%;"></td>
                                                <td style="width: 40%;"></td>
                                                <td style="width: 40%;">
                                                    <table style="width: 100%; border-spacing: 0;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 28%; height: 20px;">
                                                                    <p style="margin: 0; font-size: 12px; font-weight: 600; line-height: 22px;">Follow us:</p>
                                                                </td>
                                                                <td style="width: 12%; height: 20px; padding-top: 4px;">
                                                                    {{-- <img src="data:image/png;base64,{{ base64_encode(file_get_contents(url('images/facebook.png'))) }}" alt="icon" style="width: 20px; height: 20px; border-radius: 50%;"> --}}
                                                                    {{-- <img src="{{ url('images/facebook.png') }}" alt="icon" style="width: 20px; height: 20px; border-radius: 50%;"> --}}
                                                                </td>
                                                                <td style="width: 3%; height: 20px;">
                                                                </td>
                                                                <td style="width: 12%; height: 20px; padding-top: 4px;">
                                                                    {{-- <img src="data:image/png;base64,{{ base64_encode(file_get_contents(url('images/instagram.png'))) }}" alt="icon" style="width: 20px; height: 20px; border-radius: 50%;"> --}}
                                                                    {{-- <img src="{{ url('images/instagram.png') }}" alt="icon" style="width: 20px; height: 20px; border-radius: 50%;"> --}}
                                                                </td>
                                                                <td style="width: 3%; height: 20px;">
                                                                <td style="width: 12%; height: 20px; padding-top: 4px;">
                                                                    {{-- <img src="data:image/png;base64,{{ base64_encode(file_get_contents(url('images/youtube.png'))) }}" alt="icon" style="width: 20px; height: 20px; border-radius: 50%;"> --}}
                                                                    {{-- <img src="{{ url('images/youtube.png') }}" alt="icon" style="width: 20px; height: 20px; border-radius: 50%;"> --}}
                                                                </td>
                                                                <td style="width: 3%; height: 20px;">
                                                                <td style="width: 12%; height: 20px; padding-top: 4px;">
                                                                    {{-- <img src="data:image/png;base64,{{ base64_encode(file_get_contents(url('images/twitter.png'))) }}" alt="icon" style="width: 20px; height: 20px; border-radius: 50%;"> --}}
                                                                    {{-- <img src="{{ url('images/twitter.png') }}" alt="icon" style="width: 26px; height: 26px; border-radius: 50%;"> --}}
                                                                </td>
                                                                <td style="width: 3%; height: 20px;">
                                                                <td style="width: 12%; height: 20px; padding-top: 4px;">
                                                                    {{-- <img src="data:image/png;base64,{{ base64_encode(file_get_contents(url('images/twitter.png'))) }}" alt="icon" style="width: 20px; height: 20px; border-radius: 50%;"> --}}
                                                                    {{-- <img src="{{ url('images/linkedin.png') }}" alt="icon" style="width: 26px; height: 26px; border-radius: 50%;"> --}}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td style="width: 10%;"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <!-- empty space -->
                            <tr>
                                <td colspan="5" style="height: 32px;"></td>
                            </tr>


                            <!-- for use -->
                            <!-- <tr>
                                <td style="width: 100%">
                                    <table style="width: 100%; border-spacing: 0;">
                                        <tbody>
                                            <tr>
                                                <td width="70"></td>
                                                <td width=""></td>
                                                <td width=""></td>
                                                <td width=""></td>
                                                <td width="70"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr> -->
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