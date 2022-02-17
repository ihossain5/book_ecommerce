@extends('layouts.admin.master')
@section('title')
    Gift Wrapper Management
@endsection
@section('pageCss')

    <style>

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
                                    {{-- <h4 class="mt-0 header-title">All Wra</h4> --}}
                                </div>
                                {{-- <button type="button" class="btn btn-outline-purple float-right waves-effect waves-light"
                                    name="button" id="addButton" data-toggle="modal" data-target="#add"> Add
                                    New
                                </button> --}}
                            </div>
                            <div class="table-responsive">
                                <table id="wrapperTable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Cost</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($gift_wrapper))
                                                <tr class="offer{{ $gift_wrapper->id }}">
                                                    <td>{{ $gift_wrapper->cost }}</td>

                                                    <td>

                                                        <button type='button' class='btn btn-outline-info '
                                                            onclick='editOffer({{ $gift_wrapper->id }})'><i
                                                                class='mdi mdi-pencil'></i></button>

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
                    <h5 class="modal-title mt-0 text-center">Update cost</h5>
                    <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form class="updateWrapperForm" method="POST"> @csrf @method('PUT')
                        <input type="hidden" name="hidden_id" id="hidden_id">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Cost</label>
                                    <input type="text" class="form-control" id="edit_cost" name="cost"
                                        placeholder="Type cost" />
                                </div>
                            </div>

                        </div>

                        <div class="form-group mt-3">
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

        });

        $(document).ready(function() {
            $('#wrapperTable').DataTable({
                "ordering": false,
            });


            // update form validation
            $(".updateWrapperForm").validate({
                rules: {
                    cost: {
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
                edit: "{!! route('gift.wrapper.edit', ':id') !!}",
                update: "{!! route('gift.wrapper.update', ':id') !!}",
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
                        $('#edit_cost').val(response.data.cost)

                        $('#hidden_id').val(response.data.id)

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
        $(document).off('submit', '.updateWrapperForm');
        $(document).on('submit', '.updateWrapperForm', function(event) {
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

                        $('.offer' + response.data.id).html(
                            `
                                <td>${response.data.cost}</td>

                                <td>
                                    <button type='button' class='btn btn-outline-info' onclick='editOffer(${response.data.id})'>
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
                            $('.updateWrapperForm')[0].reset();
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


    </script>
@endsection
