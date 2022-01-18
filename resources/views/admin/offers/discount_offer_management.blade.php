@extends('layouts.admin.master')
@section('title')
    Discount Offer Management
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
                           
                            </div>
                            <div class="table-responsive">
                                <table id="offerTable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Visible Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($discount_offer))
                                                <tr class="offer{{ $discount_offer->discount_offer_id }}">

                                                    <td>
                                                        <img class="img-fluid" src="{{asset('images/'.$discount_offer->image)}}" style='width: 60px; height: 55px;'>
                                                      </td>

                                                    <td>
                                                        <label class="switch">
                                                            <input
                                                                class="is_visible is_visible_status{{ $discount_offer->discount_offer_id }}"
                                                                type="checkbox"
                                                                {{ $discount_offer->is_visible == 1 ? 'checked' : '' }}
                                                                data-id="{{ $discount_offer->discount_offer_id }}">
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </td>

                                                    <td>

                                                        {{-- <button type='button' class='btn btn-outline-dark'
                                                            onclick='viewOffer({{ $offer->offer_id }})'><i
                                                                class='fa fa-eye'></i>
                                                        </button> --}}

                                                        <button type='button' class='btn btn-outline-info '
                                                            onclick='editOffer({{ $discount_offer->discount_offer_id }})'><i
                                                                class='mdi mdi-pencil'></i></button>

                                                        {{-- <button type='button' name='delete' class="btn btn-outline-danger "
                                                            onclick="deleteOffer({{ $offer->offer_id }})"><i
                                                                class="mdi mdi-delete "></i></button> --}}

                                                    </td>
                                                </tr>
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

                        <div class="form-group ">
                            <label for=""> Photo</label>
                            <div class="custom-file edit_photo">
                                <input type="file" name="image" class="custom-file-input dropify" id="edit_photo"
                                    data-errors-position="outside" data-allowed-file-extensions='["jpg", "png","jpeg"]'
                                    data-max-file-size="0.6M" data-height="120">
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



@endsection
@section('pageScripts')

    <script>
        $('#addButton').on('click', function() {
            $('.offerAddForm').trigger('reset');
            $('.dropify-preview').hide();

        });

        $(document).ready(function() {
            $('#offerTable').DataTable({
                "ordering": false,
            });




            // add form validation
            $(".offerAddForm").validate({
                ignore: [],
                rules: {
                    image: {
                        required: true,

                    },

                },
                messages: {
                    image: {
                        required: 'Please upload offer image',
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
                edit: "{!! route('discount.offer.edit', ':id') !!}",
                update: "{!! route('discount.offer.update', ':id') !!}",
                updateStatus: "{!! route('discount.offer.update.status') !!}",
            }
        };




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
                        if (response.data.image) {
                            var photo = imagesUrl + response.data.image;
                            $("#edit_photo").attr("data-height", 150);
                            $("#edit_photo").attr("data-min-width", 450);
                            $("#edit_photo").attr("data-default-file", photo);
                            $('.edit_photo').find(".dropify-wrapper").removeClass(
                                "dropify-wrapper").addClass(
                                "dropify-wrapper has-preview");
                            $('.edit_photo').find(".dropify-preview").css('display', 'block');
                            $('.edit_photo').find('.dropify-render').html('').html('<img src=" ' +
                                photo +
                                '">')
                        } else {
                            $(".dropify-preview .dropify-render img").attr("src", "");
                        }

                        $('#hidden_id').val(response.data.discount_offer_id)

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

                        $('.offer' + response.data.discount_offer_id).html(
                            `

                            <td>
                              <img class="img-fluid" src="${imagesUrl}` +`${response.data.image}" style='width: 60px; height: 55px;'>
                            </td>


                                <td> 
                                        <label class="switch">
                                             <input class="is_visible is_visible_status${ response.data.discount_offer_id}"type="checkbox" ${response.data.is_visible==1 ? 'checked' : '' }
                                                 data-id="${response.data.discount_offer_id}">
                                                <span class="slider round"></span>
                                         </label>
                                </td>

                                <td>

                                    <button type='button' class='btn btn-outline-info' onclick='editOffer(${response.data.discount_offer_id})'>
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
