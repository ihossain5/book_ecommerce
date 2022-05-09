@extends('layouts.admin.master')
@section('title')
    Review Management
@endsection
@section('pageCss')
    <style>
.btn-custom {
    font-weight: bold;
    font-size: 20px;
    line-height: 24px;
    color: #000000;
    border-radius: 5px;
    border: none;
    padding: 7px 30px 7px 15px;
    cursor: pointer;
}
.btnAccept {
    background: #52b85c;
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
                                    <h4 class="mt-0 header-title">All Reviews</h4>
                                </div>
                                {{-- <button type="button" class="btn btn-outline-purple float-right waves-effect waves-light"
                                    name="button" id="addButton" data-toggle="modal" data-target="#add"> Add
                                    New
                                </button> --}}
                            </div>
                            <div class="table-responsive">
                                <table id="reviewtable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                           
                                            <th>Review</th>
                                            <th>Rating</th>
                                            <th>Is Active</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($reviews))
                                            @foreach ($reviews as $review)
                                                <tr class="review{{ $review->book_review_id }}">
                                                    
                                                    <td>{{ $review->review }}</td>
                                                    <td>{{ $review->rating }}</td>
                                                    <td>
                                                        <label class="switch">
                                                            <input
                                                                class="is_active is_active_status{{ $review->book_review_id }}"
                                                                type="checkbox"
                                                                {{ $review->is_active == 1 ? 'checked' : '' }}
                                                                data-id="{{ $review->book_review_id }}">
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </td>

                                                    <td>
                                                        <button type='button' name='delete' class="btn btn-outline-danger "
                                                            onclick="deleteReview({{ $review->book_review_id }})"><i
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



    

@endsection
@section('pageScripts')
    <script>
        $('#addButton').on('click', function() {
            $('.publicationAddForm').trigger('reset');
            $('.dropify-preview').hide();
        });

        $(document).ready(function() {
            $('#reviewtable').DataTable({
                "ordering": false,
            });
        
        });

        var config = {
            routes: {
                updateStatus: "{!! route('bookreview.active') !!}",

            }
        };
            

        


        // delete category
        function deleteReview(id) {
            //alert(id)
            Swal.fire({
                title: 'Are you sure?',
                text: "This Review will be deleted",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "Post",
                        url: "{!! route('bookreview.delete') !!}",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            if (response.success === true) {
                                toastr['success'](response.data.message);

                                $('#reviewtable').DataTable().row('.review' + id)
                                    .remove()
                                    .draw();
                            } else {
                                toastr['error'](response.data.message);
                            }
                        },
                        error: function(error) {
                            if (error.status == 404) {

                                toastr['error']("Data not found");
                            }
                            if (error.status == 500) {
                                toastr['error'](response.data.message);
                            }
                        },
                    });

                }
            })
        }

        // is home status change function
        $(document.body).on('click', '.is_active', function() {
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
                            type: 'is_active',
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
                    if ($('.is_active_status' + id + "").prop("checked") == true) {
                        $('.is_active_status' + id + "").prop('checked', false);
                    } else {
                        $('.is_active_status' + id + "").prop('checked', true);
                    }
                }
            })
        });
        //end
    </script>
@endsection
