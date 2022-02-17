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
                                                    <img src="{{public_path('images/logo.png')}}" alt="logo" style="width: 170px">
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
                                           
        </tbody>
    </table>
</body>

</html>
