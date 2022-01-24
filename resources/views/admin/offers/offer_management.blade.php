@extends('layouts.admin.master')
@section('title')
    Offer Management
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

        .viewOfferModalData label>span {
            font-weight: 400;
        }

        .offerData label>span {
            font-weight: 400;
        }

        .pdfobject-container {
            height: 40rem;
        }

        .previewOffer {
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
                                    <h4 class="mt-0 header-title">All Offers</h4>
                                </div>
                                {{-- <button type="button" class="btn btn-outline-purple float-right waves-effect waves-light"
                                    name="button" id="addButton" data-toggle="modal" data-target="#add"> Add
                                    New
                                </button> --}}
                            </div>
                            <div class="table-responsive">
                                <table id="offerTable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Books</th>
                                            <th>Visible Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($offers))
                                            @foreach ($offers as $offer)
                                                <tr class="offer{{ $offer->offer_id }}">
                                                    <td>{{ $offer->title }}</td>
                                                    <td>
                                                        @foreach ($offer->books->take(3) as $book)
                                                         {{ $book->title }} @if (!$loop->last) ,  @endif
                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        <label class="switch">
                                                            <input
                                                                class="is_visible is_visible_status{{ $offer->offer_id }}"
                                                                type="checkbox"
                                                                {{ $offer->is_visible == 1 ? 'checked' : '' }}
                                                                data-id="{{ $offer->offer_id }}">
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </td>

                                                    <td>

                                                        <button type='button' class='btn btn-outline-dark'
                                                            onclick='viewOffer({{ $offer->offer_id }})'><i
                                                                class='fa fa-eye'></i>
                                                        </button>

                                                        <button type='button' class='btn btn-outline-info '
                                                            onclick='editOffer({{ $offer->offer_id }})'><i
                                                                class='mdi mdi-pencil'></i></button>

                                                        {{-- <button type='button' name='delete' class="btn btn-outline-danger "
                                                            onclick="deleteOffer({{ $offer->offer_id }})"><i
                                                                class="mdi mdi-delete "></i></button> --}}

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
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h5 class="modal-title mt-0 text-center">Add a new offer</h5>
                    <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form class="offerAddForm" method="POST"> @csrf
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Type title" />
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Select Category</label>
                                    <select name="book[]" class="form-control book-select-box" multiple="multiple">

                                        @foreach ($books as $book)
                                            <option value="{{ $book->book_id }}">{{ $book->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label id="book[]-error" class="error mt-2 text-danger" for="book[]"></label>
                                </div>
                            </div>
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
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h5 class="modal-title mt-0 text-center">Update a offer</h5>
                    <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form class="updateofferForm" method="POST"> @csrf @method('PUT')
                        <input type="hidden" name="hidden_id" id="hidden_id">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" id="edit_title" name="title"
                                        placeholder="Type title" />
                                </div>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Select Category</label>
                                    <select name="book[]" class="form-control book-select-box" id="edit_book"
                                        multiple="multiple">

                                        @foreach ($books as $book)
                                            <option value="{{ $book->book_id }}">{{ $book->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label id="book[]-error" class="error mt-2 text-danger" for="book[]"></label>
                                </div>
                            </div>
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
                    <h5 class="modal-title mt-0 text-center">offer Details</h5>
                    <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-md-12">
                        <h5 class="text-center ">
                            offer Title : <span class="title"></span>
                        </h5>

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

@endsection
@section('pageScripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>
        $('#addButton').on('click', function() {
            $('.offerAddForm').trigger('reset');

            $('.book-select-box').val('');
            $('.book-select-box').trigger('change');

        });

        $(document).ready(function() {
            $('#offerTable').DataTable({
                "ordering": false,
            });

            $('.book-select-box').select2();


            // add form validation
            $(".offerAddForm").validate({
                ignore: [],
                rules: {
                    title: {
                        required: true,
                        maxlength: 100,
                    },
                    "book[]": "required",

                },
                messages: {
                    title: {
                        required: 'Please insert offer title',
                    },

                },
                errorPlacement: function(label, element) {
                    label.addClass('mt-2 text-danger');
                    label.insertAfter(element);
                },
            });
            // update form validation
            $(".updateofferForm").validate({
                rules: {
                    title: {
                        required: true,
                        maxlength: 100,
                    },

                },
                messages: {
                    title: {
                        required: 'Please insert offer name',
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
                add: "{!! route('offers.store') !!}",
                edit: "{!! route('offers.edit', ':id') !!}",
                update: "{!! route('offers.update', ':id') !!}",
                delete: "{!! route('offers.destroy', ':id') !!}",
                updateStatus: "{!! route('offer.update.status') !!}",

            }
        };

        // store category 
        $(document).off('submit', '.offerAddForm');
        $(document).on('submit', '.offerAddForm', function(event) {
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

                        var offerTable = $('#offerTable').DataTable();
                        var row = $('<tr>')

                            .append(`<td>` + response.data.title + `</td>`)
                            .append(`<td>` + response.data.data + `</td>`)

                            .append(`<td> 
                                        <label class="switch">
                                             <input class="is_visible is_visible_status${ response.data.offer_id}"type="checkbox" checked
                                                 data-id="${response.data.offer_id}">
                                                <span class="slider round"></span>
                                         </label>
                                </td>`)


                            .append(`<td>

                            <button type='button' class='btn btn-outline-dark' onclick='viewOffer(${response.data.offer_id})'>
                                  <i class='fa fa-eye'></i>
                             </button>
                            <button type='button' class='btn btn-outline-info' onclick='editOffer(${response.data.offer_id})'>
                                <i class='mdi mdi-pencil'></i>
                            </button>
                            <button type='button'  name='delete' class="btn btn-outline-danger"onclick="deleteOffer(${response.data.offer_id})">
                                <i class="mdi mdi-delete "></i>
                            </button>
                         </td>`)


                        var offer_row = offerTable.row.add(row).draw().node();
                        $('#offerTable tbody').prepend(row);
                        $(offer_row).addClass('offer' + response.data.offer_id + '');
                        $('.offerAddForm').trigger('reset');

                        if (response.data.message) {
                            $('#add').modal('hide');
                            toastMixin.fire({
                                icon: 'success',
                                animation: true,
                                title: "" + response.data.message + ""
                            });

                        }


                    } else {
                        toastMixin.fire({
                            icon: 'error',
                            animation: true,
                            title: "" + response.data + ""
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


        function viewOffer(id) {
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

                        $('.previewOffer').attr('onclick', `readoffer(${response.data.offer_id})`);

                        $('.offerData').empty();
                        $.each(response.data.feature_attributes, function(key, val) {
                            $('.offerData').append(`
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
        function editOffer(id) {
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

                        var books_ids = [];
                        $.each(response.data.books, function(key, value) {
                            books_ids.push(value.book_id)
                        });

                        $('#edit_book').val(books_ids);
                        $('#edit_book').trigger('change');

                        $('#hidden_id').val(response.data.offer_id)

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


        // update offer
        $(document).off('submit', '.updateofferForm');
        $(document).on('submit', '.updateofferForm', function(event) {
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

                        $('.offer' + response.data.offer_id).html(
                            `

                                <td>${response.data.title}</td>
                                <td>${response.data.data}</td>

                                <td> 
                                        <label class="switch">
                                             <input class="is_visible is_visible_status${ response.data.offer_id}"type="checkbox" ${response.data.is_visible==1 ? 'checked' : '' }
                                                 data-id="${response.data.offer_id}">
                                                <span class="slider round"></span>
                                         </label>
                                </td>

                                <td>

                                    <button type='button' class='btn btn-outline-dark' onclick='viewOffer(${response.data.offer_id})'>
                                       <i class='fa fa-eye'></i>
                                    </button>
                                    <button type='button' class='btn btn-outline-info' onclick='editOffer(${response.data.offer_id})'>
                                        <i class='mdi mdi-pencil'></i>
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
                            $('.updateofferForm')[0].reset();
                        }


                    } else {
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
        function deleteOffer(id) {
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
                                $('#offerTable').DataTable().row('.offer' + id)
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


    </script>
@endsection
