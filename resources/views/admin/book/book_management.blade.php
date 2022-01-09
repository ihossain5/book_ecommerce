@extends('layouts.admin.master')
@section('title')
    Book Management
@endsection
@section('pageCss')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                                    <h4 class="mt-0 header-title">All Books</h4>
                                </div>
                                <button type="button" class="btn btn-outline-purple float-right waves-effect waves-light"
                                    name="button" id="addButton" data-toggle="modal" data-target="#add"> Add
                                    New
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table id="bookTable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Cover Image</th>
                                            <th>Title</th>
                                            <th>ISBN Number</th>
                                            <th>Regular Price</th>
                                            <th>Discounted Price</th>
                                            <th>Available Status</th>
                                            <th>Visible Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($books))
                                            @foreach ($books as $book)
                                                <tr class="book{{ $book->book_id }}">
                                                    <td>
                                                        <img class='img-fluid'
                                                            src="{{ asset('images/' . $book->cover_image) }}"
                                                            alt="{{ $book->name }}" style='width: 60px; height: 55px;'>
                                                    </td>
                                                    <td>{{ $book->title }}</td>
                                                    <td>{{ $book->isbn }}</td>
                                                    <td>{{ currency_format($book->regular_price) }}</td>
                                                    <td>{{ currency_format($book->discounted_price) }}</td>

                                                    <td>
                                                        <label class="switch">
                                                            <input
                                                                class="is_available is_available_status{{ $book->book_id }}"
                                                                type="checkbox"
                                                                {{ $book->is_available == 1 ? 'checked' : '' }}
                                                                data-id="{{ $book->book_id }}">
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="switch">
                                                            <input
                                                                class="is_visible is_visible_status{{ $book->book_id }}"
                                                                type="checkbox"
                                                                {{ $book->is_visible == 1 ? 'checked' : '' }}
                                                                data-id="{{ $book->book_id }}">
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </td>

                                                    <td>
                                                        <a type='button' class='btn btn-outline-primary'
                                                        href="{{ route('book.review', $book->book_id) }}"><i
                                                            class='fa fa-file'></i></a>

                                                        <button type='button' class='btn btn-outline-dark'
                                                            onclick='viewBook({{ $book->book_id }})'><i
                                                                class='fa fa-eye'></i>
                                                        </button>

                                                        <button type='button' class='btn btn-outline-info '
                                                            onclick='editBook({{ $book->book_id }})'><i
                                                                class='mdi mdi-pencil'></i></button>

                                                        <button type='button' name='delete' class="btn btn-outline-danger "
                                                            onclick="deleteBook({{ $book->book_id }})"><i
                                                                class="mdi mdi-delete "></i></button>

                                                    </td>
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


    <!-- Add  Modal -->
    <div class="modal fade bs-example-modal-center" id="add" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h5 class="modal-title mt-0 text-center">Add a new book</h5>
                    <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form class="bookAddForm" method="POST"> @csrf
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Type title" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ISBN Number</label>
                                    <input type="text" class="form-control" name="isbn" placeholder="Type isbn number" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Select Publication</label>
                                    <select name="publication_id" class="form-control" id="">
                                        <option value="">Select</option>
                                        @foreach ($publications as $publication)
                                            <option value="{{ $publication->publication_id }}">
                                                {{ $publication->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Select Category</label>
                                    <select name="category[]" class="form-control category-select-box" multiple="multiple">
                                        {{-- <option value="">Select Category</option> --}}
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->category_id }}">{{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label id="category[]-error" class="error mt-2 text-danger" for="category[]"></label>
                                </div>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Select Author</label>
                                    <select name="author[]" class="form-control author-select-box" multiple="multiple">
                                        {{-- <option value="">Select Author</option> --}}
                                        @foreach ($authors as $author)
                                            <option value="{{ $author->author_id }}">{{ $author->name }}</option>
                                        @endforeach
                                    </select>
                                    <label id="author[]-error" class="error mt-2 text-danger" for="author[]"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea name="short_description" class="form-control" cols="30" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Long Description</label>
                                    <textarea name="long_description" class="form-control" cols="30" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Regular Price</label>
                                    <input type="number" onkeyup="getDiscountedPrice(this)" min="1" class="form-control" name="regular_price"
                                        id="regularPrice">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Discount Percentage</label>
                                    <input type="number" onkeyup="getDiscount(this)" min="0" class="form-control"
                                        id="discount_percentage" name="discount_percentage">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Discounted Price</label>
                                    <input type="number" min="0" readonly class="form-control" name="discounted_price"
                                        id="discounted_price">
                                </div>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for=""> Cover Photo</label>
                                    <div class="custom-file">
                                        <input type="file" name="cover_photo" class="custom-file-input dropify"
                                            data-errors-position="outside"
                                            data-allowed-file-extensions='["jpg", "png","jpeg"]' data-max-file-size="0.6M"
                                            data-height="120">
                                    </div>
                                    <label id="cover_photo-error" class="error mt-2 text-danger" for="cover_photo"></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="">Back Side Photo</label>
                                    <div class="custom-file">
                                        <input type="file" name="back_photo" class="custom-file-input dropify"
                                            data-errors-position="outside"
                                            data-allowed-file-extensions='["jpg", "png","jpeg"]' data-max-file-size="0.6M"
                                            data-height="120">
                                    </div>
                                    <label id="back_photo-error" class="error mt-2 text-danger" for="back_photo"></label>
                                </div>
                            </div>

                        </div>


                        <div class="form-group ">
                            <label for="">Book Preview (PDF only)</label>
                            <div class="custom-file">
                                <input type="file" name="preview_book" class="custom-file-input dropify"
                                    data-errors-position="outside" data-allowed-file-extensions='["pdf"]'
                                    data-max-file-size="0.6M" data-height="120">
                            </div>
                            <label id="preview_book-error" class="error mt-2 text-danger" for="preview_book"></label>

                        </div>

                        <div class="form-row">
                            @if (!empty($attributes))
                                @foreach ($attributes as $key => $attribute)
                                    <div class="col-md-2">
                                        <div class="form-group attributeCheckbox">
                                            {{-- <label></label> --}}
                                            <label class="ms-checkbox-wrap ms-checkbox-dark attributeLabel">
                                                <input type="checkbox" onclick="checkbox(this)"
                                                    data-id="{{ $attribute->feature_attribute_id }}" value="">
                                                <i class="ms-checkbox-check"></i>
                                            </label>
                                            <span> {{ $attribute->name }} </span>
                                        </div>
                                    </div>
                                    <div class=" col-md-4">
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control input_box attribute_val{{ $attribute->feature_attribute_id }}"
                                                disabled name="attribute[{{ $attribute->feature_attribute_id }}]"
                                                id="value{{ $attribute->feature_attribute_id }}">
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>

                        <div class="form-group mt-4">
                            <div>
                                <button type="submit" class="btn btn-block btn-success waves-effect waves-light">
                                    Submit
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- Add  Modal End -->

    <!-- Edit  Modal -->
    <div class="modal fade bs-example-modal-center" id="edit_modal" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h5 class="modal-title mt-0 text-center">Update a book</h5>
                    <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form class="updatebookForm" method="POST"> @csrf @method('PUT')
                        <input type="hidden" name="hidden_id" id="hidden_id">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" id="edit_title" name="title"
                                        placeholder="Type title" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ISBN Number</label>
                                    <input type="text" class="form-control" id="edit_isbn" name="isbn"
                                        placeholder="Type isbn number" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Select Publication</label>
                                    <select name="publication_id" class="form-control" id="edit_publication_id">
                                        <option value="">Select</option>
                                        @foreach ($publications as $publication)
                                            <option value="{{ $publication->publication_id }}">
                                                {{ $publication->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Select Category</label>
                                    <select name="category[]" class="form-control category-select-box" id="edit_category"
                                        multiple="multiple">
                                        {{-- <option value="">Select Category</option> --}}
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->category_id }}">{{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label id="category[]-error" class="error mt-2 text-danger" for="category[]"></label>
                                </div>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Select Author</label>
                                    <select name="author[]" class="form-control author-select-box" id="edit_author"
                                        multiple="multiple">
                                        {{-- <option value="">Select Author</option> --}}
                                        @foreach ($authors as $author)
                                            <option value="{{ $author->author_id }}">{{ $author->name }}</option>
                                        @endforeach
                                    </select>
                                    <label id="author[]-error" class="error mt-2 text-danger" for="author[]"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea name="short_description" class="form-control" id="edit_short_description"
                                        cols="30" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Long Description</label>
                                    <textarea name="long_description" class="form-control" id="edit_long_description"
                                        cols="30" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Regular Price</label>
                                    <input type="number" onkeyup="getDiscountedPriceEdit(this)" min="1" class="form-control" id="edit_regular_price"
                                        name="regular_price">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Discount Percentage</label>
                                    <input type="number" onkeyup="getDiscountEdit(this)" min="0"
                                        id="edit_discount_percentage" class="form-control" name="discount_percentage">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Discounted Price</label>
                                    <input type="number" min="0" readonly class="form-control" id="edit_discounted_price"
                                        name="discounted_price">
                                </div>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for=""> Cover Photo</label>
                                    <div class="custom-file coverPhoto">
                                        <input type="file" id="edit_cover_photo" name="cover_photo"
                                            class="custom-file-input " data-errors-position="outside"
                                            data-allowed-file-extensions='["jpg", "png","jpeg"]' data-max-file-size="0.6M"
                                            data-height="120">
                                    </div>
                                    <label id="cover_photo-error" class="error mt-2 text-danger" for="cover_photo"></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="">Back Side Photo</label>
                                    <div class="custom-file back_photo">
                                        <input type="file" name="back_photo" id="edit_back_photo"
                                            class="custom-file-input " data-errors-position="outside"
                                            data-allowed-file-extensions='["jpg", "png","jpeg"]' data-max-file-size="0.6M"
                                            data-height="120">
                                    </div>
                                    <label id="back_photo-error" class="error mt-2 text-danger" for="back_photo"></label>
                                </div>
                            </div>

                        </div>


                        <div class="form-group ">
                            <label for="">Book Preview (PDF only)</label>
                            <div class="custom-file preview_book">
                                <input type="file" name="preview_book" id="edit_preview_book" class="custom-file-input "
                                    data-errors-position="outside" data-allowed-file-extensions='["pdf"]'
                                    data-max-file-size="0.6M" data-height="120">
                            </div>
                            <label id="preview_book-error" class="error mt-2 text-danger" for="preview_book"></label>

                        </div>

                        <div class="form-row">
                            @if (!empty($attributes))
                                @foreach ($attributes as $key => $attribute)
                                    <div class="col-md-2">
                                        <div class="form-group attributeCheckbox">
                                            {{-- <label></label> --}}
                                            <label class="ms-checkbox-wrap ms-checkbox-dark attributeLabel">
                                                <input type="checkbox" onclick="checkbox(this)"
                                                    class="input_checkbox checkbox{{ $attribute->feature_attribute_id }}"
                                                    data-id="{{ $attribute->feature_attribute_id }}" value="">
                                                <i class="ms-checkbox-check"></i>
                                            </label>
                                            <span> {{ $attribute->name }} </span>
                                        </div>
                                    </div>
                                    <div class=" col-md-4">
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control input_box attribute_val{{ $attribute->feature_attribute_id }}"
                                                disabled name="attribute[{{ $attribute->feature_attribute_id }}]"
                                                id="value{{ $attribute->feature_attribute_id }}">
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-block btn-success waves-effect waves-light">
                                    Update
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- Edit  Modal End -->

    <!-- view  Modal -->
    <div class="modal fade bs-example-modal-center" id="viewModal" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h5 class="modal-title mt-0 text-center">Book Details</h5>
                    <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-md-12">
                        <h5 class="text-center ">
                            Book Title : <span class="title"></span>
                        </h5>
                        <div class="form-row">
                            <div class="col-md-6">
                                <img class="mt-2" src="" id="cover_image" style="width: 100%;">
                            </div>
                            <div class="col-md-6">
                                <img class="mt-2" src="" id="backside_image" style="width: 100%;">
                            </div>
                        </div>
                        <div class="form-row mt-4 viewBookModalData">
                            <div class="col-md-6">
                                <label> Isbn : <span class="isbnNumber"></span></label>
                            </div>
                            <div class="col-md-6">
                                <label>Preview Book : <span class="previewBook">Click to Read</span> </label>
                            </div>
                            <div class="col-md-6">
                                <label>Short Description : <span class="short_description"></span> </label>
                            </div>
                            <div class="col-md-6">
                                <label>Long Description : <span class="long_description"></span> </label>
                            </div>
                            <div class="col-md-6">
                                <label>Regular Price : <span class="regular_price"></span> </label>
                            </div>
                            <div class="col-md-6">
                                <label>Discounted Price : <span class="discounted_price"></span> </label>
                            </div>

                            <div class="col-md-6">
                                <label>Discount Percentage : <span class="discounted_percentage"></span> </label>
                            </div>
                            <div class="col-md-6">
                                <label>Available Status: <span class="availAbleStatus"></span> </label>
                            </div>
                            <div class="col-md-6">
                                <label>Visible Status: <span class="visibleStatus"></span> </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <h5>Book Specifications</h5>
                            </div>
                        </div>

                        <div class="form-row bookData">

                        </div>
                        {{-- <div class="ms-form-group view-modal">
                            <p class="pb-3">
                                <strong>book Name:</strong> <span id="view_name"></span><br>
                                <strong>book Description:</strong> <span id="view_description"></span><br>
                                <strong>book Photo :</strong><br>
                                <img class="mt-2" src="" id="view_image" style="width: 100%;">
                            </p>
                        </div> --}}
                    </div>
                </div>
                <div class="col-md-12 ">
                    <div class="row">
                        <div class="col-md-12 ">
                            <button data-dismiss="modal" class="btn btn-block btnAccept mb-3 "> Done</button>
                        </div>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- view  Modal End -->


    <div class="modal fade bs-example-modal-center pdf_view" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h5 class="modal-title mt-0 text-center">Book Preview</h5>
                    <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="pdf_viewer"></div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection
@section('pageScripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.6/pdfobject.min.js"
        integrity="sha512-B+t1szGNm59mEke9jCc5nSYZTsNXIadszIDSLj79fEV87QtNGFNrD6L+kjMSmYGBLzapoiR9Okz3JJNNyS2TSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('backend/assets/js/discountCalculation.js') }}"></script>
    <script>
        $('#addButton').on('click', function() {
            $('.bookAddForm').trigger('reset');
            $('.dropify-preview').hide();

            $('.category-select-box').val('');
            $('.category-select-box').trigger('change');

            $('.author-select-box').val('');
            $('.author-select-box').trigger('change');

            $('.input_box' ).prop('disabled', true).val('');
        });

        $(document).ready(function() {
            $('#bookTable').DataTable({
                "ordering": false,
            });

            $('.category-select-box').select2();
            $('.author-select-box').select2();

            // add form validation
            $(".bookAddForm").validate({
                ignore: [],
                rules: {
                    title: {
                        required: true,
                        maxlength: 100,
                    },
                    isbn: {
                        required: true,
                        maxlength: 100,
                    },
                    long_description: {
                        required: true,
                        maxlength: 1000,
                    },
                    short_description: {
                        required: true,
                        maxlength: 1000,
                    },
                    cover_photo: {
                        required: true,
                    },
                    back_photo: {
                        required: true,
                    },
                    preview_book: {
                        required: true,
                    },
                    regular_price: {
                        required: true,
                    },
                    discounted_price: {
                        required: true,
                    },
                    discount_percentage: {
                        required: true,
                    },
                    publication_id: {
                        required: true,
                    },
                    "author[]": "required",
                    "category[]": "required",

                },
                messages: {
                    title: {
                        required: 'Please insert book title',
                    },
                    isbn: {
                        required: 'Please insert isbn number',
                    },
                    short_description: {
                        required: 'Please insert short description',
                    },
                    long_description: {
                        required: 'Please insert long description',
                    },
                    cover_photo: {
                        required: 'Please upload book cover photo',
                    },
                    back_photo: {
                        required: 'Please upload book back side photo',
                    },
                    preview_book: {
                        required: 'Please upload pdf for book preview',
                    },
                    // author[]: {
                    //     required: 'Please select book author',
                    // },
                    // category[]: {
                    //     required: 'Please select book category',
                    // },
                    publication_id: {
                        required: 'Please select book publication',
                    },
                    regular_price: {
                        required: 'Please insert book regular price',
                    },
                    discount_percentage: {
                        required: 'Please insert discount percentage',
                    },

                },
                errorPlacement: function(label, element) {
                    label.addClass('mt-2 text-danger');
                    label.insertAfter(element);
                },
            });
            // update form validation
            $(".updatebookForm").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 100,
                    },

                },
                messages: {
                    name: {
                        required: 'Please insert book name',
                    },

                },
                errorPlacement: function(label, element) {
                    label.addClass('mt-2 text-danger');
                    label.insertAfter(element);
                },
            });
        });

        var config = {
            routes: {
                add: "{!! route('books.store') !!}",
                edit: "{!! route('books.edit', ':id') !!}",
                update: "{!! route('books.update', ':id') !!}",
                delete: "{!! route('books.destroy', ':id') !!}",
                updateStatus: "{!! route('books.status.update') !!}",
                getPdf: "{!! route('book.get.pdf', ':id') !!}",
            }
        };

        // store category 
        $(document).off('submit', '.bookAddForm');
        $(document).on('submit', '.bookAddForm', function(event) {
            event.preventDefault();
            $.ajax({
                url: config.routes.add,
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        var bookTable = $('#bookTable').DataTable();
                        var row = $('<tr>')
                            .append(`<td><img class="img-fluid" src="${imagesUrl}` +
                                `${response.data.backside_image}" style='width: 60px; height: 55px;'></td>`
                            )
                            .append(`<td>` + response.data.title + `</td>`)
                            .append(`<td>` + response.data.isbn + `</td>`)
                            .append(`<td> ৳ ` + bdCurrencyFormat(response.data.regular_price) + `</td>`)
                            .append(`<td> ৳ ` + bdCurrencyFormat(response.data.discounted_price) +
                                `</td>`)

                            .append(`<td> 
                                        <label class="switch">
                                             <input class="is_available is_available_status${ response.data.book_id}"type="checkbox" checked
                                                 data-id="${response.data.book_id}">
                                                <span class="slider round"></span>
                                         </label>
                                </td>`)

                            .append(`<td> 
                                        <label class="switch">
                                             <input class="is_visible is_visible_status${ response.data.book_id}"type="checkbox" checked
                                                 data-id="${response.data.book_id}">
                                                <span class="slider round"></span>
                                         </label>
                                </td>`)


                            .append(`<td>
                            <button type='button' class='btn btn-outline-dark' onclick='viewBook(${response.data.book_id})'>
                                  <i class='fa fa-eye'></i>
                             </button>
                            <button type='button' class='btn btn-outline-info' onclick='editBook(${response.data.book_id})'>
                                <i class='mdi mdi-pencil'></i>
                            </button>
                            <button type='button'  name='delete' class="btn btn-outline-danger"onclick="deleteBook(${response.data.book_id})">
                                <i class="mdi mdi-delete "></i>
                            </button>
                         </td>`)


                        var book_row = bookTable.row.add(row).draw().node();
                        $('#bookTable tbody').prepend(row);
                        $(book_row).addClass('book' + response.data.book_id + '');
                        $('.bookAddForm').trigger('reset');

                        if (response.data.message) {
                            $('#add').modal('hide');
                            toastMixin.fire({
                                icon: 'success',
                                animation: true,
                                title: "" + response.data.message + ""
                            });

                        }


                    } else if (response.success == false) {
                        toastMixin.fire({
                            icon: 'error',
                            animation: true,
                            title: "" + response.data + ""
                        });
                    } else {
                        toastMixin.fire({
                            icon: 'error',
                            animation: true,
                            title: "" + response.data.error + ""
                        });

                    }
                }, //success end
                error: function(error) {
                    if (error.status == 422) {
                        $.each(error.responseJSON.errors, function(i, message) {
                            toastMixin.fire({
                                icon: 'error',
                                animation: true,
                                title: "" + message + ""
                            });
                        });

                    }
                    if (error.status == 500) {
                        toastMixin.fire({
                            icon: 'error',
                            animation: true,
                            title: "" + error.responseJSON.message + ""
                        });
                    }
                },

            });
        });


        function viewBook(id) {
            var url = config.routes.edit;
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                method: "get",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        $('.title').text(response.data.title);

                        if (response.data.backside_image != null) {
                            $('#cover_image').attr('src', imagesUrl + response.data.cover_image);
                            $('#backside_image').attr('src', imagesUrl + response.data.backside_image);
                        }
                        $('.isbnNumber').html(response.data.isbn)
                        $('.short_description').html(response.data.short_description)
                        $('.long_description').html(response.data.long_description)
                        $('.discounted_percentage').html(response.data.discounted_percentage + ' %')
                        $('.regular_price').html(response.data.regular_price)
                        $('.discounted_price').html(response.data.discounted_price)
                        $('.visibleStatus').html(response.data.is_visible == 1 ? 'Visible' : 'Not visible')
                        $('.availAbleStatus').html(response.data.is_available == 1 ? 'Available' :
                            'Not abailable')

                        $('.previewBook').attr('onclick', `readBook(${response.data.book_id})`);

                        $('.bookData').empty();
                        $.each(response.data.feature_attributes, function(key, val) {
                            $('.bookData').append(`
                            <div class="col-md-6">
                               <label>${val.name} : <span>${val.pivot.value}</span> </label>
                            </div>
                            `)
                        });

                        $('#viewModal').modal('show');

                    } //success end

                },
                error: function(error) {
                    if (error.status == 404) {
                        toastMixin.fire({
                            icon: 'error',
                            animation: true,
                            title: "" + 'Data not found' + ""
                        });


                    }
                },
            }); //ajax end
        }

        //edit a category
        function editBook(id) {
            var url = config.routes.edit;
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                method: "get",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        $('#edit_title').val(response.data.title)
                        $('#edit_isbn').val(response.data.isbn)
                        $('#edit_isbn').val(response.data.isbn)
                        $('#edit_publication_id').val(response.data.publication_id)


                        var category_ids = [];
                        $.each(response.data.categories, function(key, value) {
                            category_ids.push(value.category_id)
                        });

                        $('#edit_category').val(category_ids);
                        $('#edit_category').trigger('change');

                        var author_ids = [];
                        $.each(response.data.authors, function(i, val) {
                            author_ids.push(val.author_id)
                        });

                        $('#edit_author').val(author_ids);
                        $('#edit_author').trigger('change');


                        $('#edit_short_description').val(response.data.short_description)

                        $('#edit_long_description').val(response.data.long_description)

                        $('#edit_regular_price').val(response.data.regular_price)

                        $('#edit_discount_percentage').val(response.data.discounted_percentage)
                        $('#edit_discounted_price').val(response.data.discounted_price)

                        $('#hidden_id').val(response.data.book_id)

                        // specifications
                        $('.input_box').val('');
                        $('.input_box').prop('disabled', true);
                        $('.input_checkbox').prop('checked', false);

                        $.each(response.data.feature_attributes, function(key, data) {
                            $('.checkbox' + data.feature_attribute_id).prop('checked', true);
                            $('.attribute_val' + data.feature_attribute_id).val(data.pivot.value);
                            $('.attribute_val' + data.feature_attribute_id).prop('disabled', false)
                                .prop('required', true).prop('maxlength', 50);
                        });

                        //cover image start
                        if (response.data.cover_image) {
                            var image = response.data.cover_image;
                            var imageId = '#edit_cover_photo';
                            var imageClass = '.coverPhoto';
                            var location = '/images/';
                            showImageIntoModal(image, imageId, imageClass,location)
                        } else {
                            $('.coverPhoto').find(".dropify-preview .dropify-render img").attr("src", "");
                        }
                        //cover image end

                        //back side image start
                        if (response.data.backside_image) {
                            var image = response.data.backside_image;
                            var imageId = '#edit_back_photo';
                            var imageClass = '.back_photo';
                            var location = '/images/';
                            showImageIntoModal(image, imageId, imageClass,location)
                        } else {
                            $('.back_photo').find(".dropify-preview .dropify-render img").attr("src", "");
                        }
                        //back side image end

                        //preview pdf start
                        if (response.data.book_preview) {
                            var image = response.data.book_preview;
                            var imageId = '#edit_preview_book';
                            var imageClass = '.preview_book';
                            var location = '/pdfs/';
                            showImageIntoModal(image, imageId, imageClass,location)
                        } else {
                            $('.preview_book').find(".dropify-preview .dropify-render img").attr("src", "");
                        }
                        //preview pdf start end



                        $('#edit_modal').modal('show');

                    } //success end

                },
                error: function(error) {
                    if (error.status == 404) {
                        toastMixin.fire({
                            icon: 'error',
                            animation: true,
                            title: "" + 'Data not found' + ""
                        });


                    }
                },
            });

        }

        function showImageIntoModal(image, imageId, imageClass,location_path) {
            var main_path = location.origin;
            var img_url = main_path + location_path + image;

            $(imageId).attr("data-default-file", img_url);
            $(imageClass).find('.dropify-wrapper').removeClass("dropify-wrapper").addClass(
                "dropify-wrapper has-preview");
            $(imageClass).find(".dropify-preview").css('display', 'block');
            $(imageClass).find('.dropify-render').html('').html('<img src=" ' + img_url +
                '">')

            $(imageId).dropify({
                error: {
                    'fileSize': 'The file size is too big ( 600KB  max).',
                }
            });

        }

        // update category
        $(document).off('submit', '.updatebookForm');
        $(document).on('submit', '.updatebookForm', function(event) {
            event.preventDefault();
            var id = $('#hidden_id').val();

            var update_url = config.routes.update;
            update_url = update_url.replace(':id', id);

            $.ajax({
                url: update_url,
                method: "post",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(response) {

                    if (response.success == true) {
                        $('.book' + response.data.book_id).html(
                            `
                            <td>
                              <img class="img-fluid" src="${imagesUrl}` + `${response.data.cover_image}" style='width: 60px; height: 55px;'>
                            </td>
                                <td>${response.data.title}</td>
                                <td>${response.data.isbn}</td>
                                <td>৳ ${bdCurrencyFormat(response.data.regular_price)}</td>
                                <td>৳ ${bdCurrencyFormat(response.data.discounted_price)}</td>

                                <td> 
                                        <label class="switch">
                                             <input class="is_available is_available_status${ response.data.book_id}"type="checkbox" ${response.data.is_available==1 ? 'checked' : '' }
                                                 data-id="${response.data.book_id}">
                                                <span class="slider round"></span>
                                         </label>
                                </td>

                                <td> 
                                        <label class="switch">
                                             <input class="is_visible is_visible_status${ response.data.book_id}"type="checkbox" ${response.data.is_visible==1 ? 'checked' : '' }
                                                 data-id="${response.data.book_id}">
                                                <span class="slider round"></span>
                                         </label>
                                </td>

                                <td>
                                    <button type='button' class='btn btn-outline-dark' onclick='viewBook(${response.data.book_id})'>
                                       <i class='fa fa-eye'></i>
                                    </button>
                                    <button type='button' class='btn btn-outline-info' onclick='editBook(${response.data.book_id})'>
                                        <i class='mdi mdi-pencil'></i>
                                    </button>
                                    <button type='button'  name='delete' class="btn btn-outline-danger"onclick="deleteBook(${response.data.book_id})">
                                        <i class="mdi mdi-delete "></i>
                                    </button>
                                </td>
                                `
                        );
                        if (response.data.message) {
                            $('#edit_modal').modal('hide');
                            toastMixin.fire({
                                icon: 'success',
                                animation: true,
                                title: "" + response.data.message + ""
                            });
                            $('.updatebookForm')[0].reset();
                        }


                    } else if (response.success == false) {
                        toastMixin.fire({
                            icon: 'error',
                            animation: true,
                            title: "" + response.data + ""
                        });
                    } else {
                        toastMixin.fire({
                            icon: 'error',
                            animation: true,
                            title: "" + response.data.error + ""
                        });

                    }

                }, //success end
                error: function(error) {
                    if (error.status == 404) {
                        toastMixin.fire({
                            icon: 'error',
                            animation: true,
                            title: "" + 'Data not found' + ""
                        });


                    } else if (error.status == 422) {
                        $.each(error.responseJSON.errors, function(i, message) {
                            toastMixin.fire({
                                icon: 'error',
                                animation: true,
                                title: "" + message + ""
                            });
                        });

                    } else if (error.status == 500) {
                        toastMixin.fire({
                            icon: 'error',
                            animation: true,
                            title: "" + error.responseJSON.message + ""
                        });
                    }
                },

            });
        });


        // delete category
        function deleteBook(id) {
            // alert(id)
            Swal.fire({
                title: 'Are you sure?',
                text: "All of items under this category will also be deleted",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var delete_url = config.routes.delete;
                    delete_url = delete_url.replace(':id', id);
                    $.ajax({
                        type: "Delete",
                        url: delete_url,
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            if (response.success === true) {
                                toastMixin.fire({
                                    icon: 'success',
                                    animation: true,
                                    title: "" + response.data.message + ""
                                });
                                $('#bookTable').DataTable().row('.book' + id)
                                    .remove()
                                    .draw();
                                $('#viewModal').modal('hide');
                            } else {
                                Swal.fire("Error!", "" + response.message + "", "error");
                            }
                        },
                        error: function(error) {
                            if (error.status == 404) {
                                toastMixin.fire({
                                    icon: 'error',
                                    animation: true,
                                    title: "" + 'Data not found' + ""
                                });


                            }
                            if (error.status == 500) {
                                toastMixin.fire({
                                    icon: 'error',
                                    animation: true,
                                    title: "" + error.responseJSON.message + ""
                                });
                            }
                        },
                    });

                }
            })


        }
        //end


        // checkbox selcet function
        function checkbox(e) {
            var id = $(e).data('id');
            if ($(e).is(':checked')) {
                $('.attribute_val' + id).prop('disabled', false).prop('required', true).prop('maxlength', 50);

            } else {
                $('.attribute_val' + id).prop('disabled', true).prop('required', false).val('');

            }
        }

        // is home status change function
        $(document.body).on('click', '.is_available', function() {
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Change this status!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: config.routes.updateStatus,
                        method: "POST",
                        data: {
                            id: id,
                            type: 'is_available',
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success == true) {
                                toastMixin.fire({
                                    icon: 'success',
                                    animation: true,
                                    title: "" + response.data.message + ""
                                });
                            } else if (response.success == false) {
                                toastMixin.fire({
                                    icon: 'error',
                                    animation: true,
                                    title: "" + response.data + ""
                                });
                            }
                        }, //success end
                        error: function(error) {
                            if (error.status == 404) {
                                toastMixin.fire({
                                    icon: 'error',
                                    animation: true,
                                    title: "" + 'Data not found' + ""
                                });


                            }
                        },

                    }); //ajax end
                } else {
                    if ($('.is_available_status' + id + "").prop("checked") == true) {
                        $('.is_available_status' + id + "").prop('checked', false);
                    } else {
                        $('.is_available_status' + id + "").prop('checked', true);
                    }
                }
            })
        });

        // is nav status change function
        $(document.body).on('click', '.is_visible', function() {
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Change this status!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: config.routes.updateStatus,
                        method: "POST",
                        data: {
                            id: id,
                            type: 'is_visible',
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success == true) {
                                toastMixin.fire({
                                    icon: 'success',
                                    animation: true,
                                    title: "" + response.data.message + ""
                                });
                            } else if (response.success == false) {
                                toastMixin.fire({
                                    icon: 'error',
                                    animation: true,
                                    title: "" + response.data + ""
                                });
                            }
                        }, //success end
                        error: function(error) {
                            if (error.status == 404) {
                                toastMixin.fire({
                                    icon: 'error',
                                    animation: true,
                                    title: "" + 'Data not found' + ""
                                });


                            }
                        },

                    }); //ajax end
                } else {
                    if ($('.is_visible_status' + id + "").prop("checked") == true) {
                        $('.is_visible_status' + id + "").prop('checked', false);
                    } else {
                        $('.is_visible_status' + id + "").prop('checked', true);
                    }
                }
            })
        });

        function readBook(id) {
            var path = window.location.origin;
            var url = config.routes.getPdf;
            url = url.replace(':id', id);
            // var url = path.slice(0, -14);
            $.ajax({
                url: url,
                method: "get",
                data: {
                    type: 'is_visible',
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        PDFObject.embed(path + "/pdfs/" + response.data, ".pdf_viewer");
                        $('.pdf_view').modal('show');
                    } else if (response.success == false) {
                        toastMixin.fire({
                            icon: 'error',
                            animation: true,
                            title: "" + response.data + ""
                        });
                    }
                }, //success end
                error: function(error) {
                    if (error.status == 404) {
                        toastMixin.fire({
                            icon: 'error',
                            animation: true,
                            title: "" + 'Data not found' + ""
                        });


                    }
                },

            }); //ajax end

        }
    </script>
@endsection
