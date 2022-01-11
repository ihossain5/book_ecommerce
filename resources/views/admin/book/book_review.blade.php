@extends('layouts.admin.master')
@section('title')
    Book Reviews
@endsection
@section('pageCss')
    <style>
        .attributeLabel {
            margin-right: 10px;
        }

        .attributeCheckbox {
            margin-top: 5px;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #dc3545;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #198754;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #018346;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .viewBookModalData label>span {
            font-weight: 400;
        }

        .bookData label>span {
            font-weight: 400;
        }

        .pdfobject-container {
            height: 40rem;
        }

        .previewBook {
            cursor: pointer;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            /* display: none; <- Crashes Chrome on hover */
            -webkit-appearance: none;
            margin: 0;
            /* <-- Apparently some margin are still there even though it's hidden */
        }

        input[type=number] {
            -moz-appearance: textfield;
            /* Firefox */
        }

    </style>
@endsection
@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <div class="ms-header-text">
                                    <h4 class="mt-0 header-title">Book Name- {{ $book_name }} <span style="padding-left:150px">Total Reviews: {{ $count }}</span></h4>
                                    <h4 class="mt-0 header-title"><span style="padding-left:370px">Avg Rating: {{ $avg_rating }}</span></h4>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="book_review_table" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Review</th>
                                            <th>Rating</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($book_reivews))
                                            @foreach ($book_reivews as $book_reivew)
                                                <tr>
                                                    <td>{{ $book_reivew->user->name??'N/A' }}</td>
                                                    <td>{{ $book_reivew->review }}</td>
                                                    <td>{{ $book_reivew->rating }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
@endsection
@section('pageScripts')
<script>
    $(document).ready(function() {
        $('#book_review_table').DataTable({
            "ordering": false,
        });
    });
</script>
@endsection
