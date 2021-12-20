@extends('layouts.admin.master')
@section('title')
    Feature Attribute
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
                                    <h4 class="mt-0 header-title">All Feature Attributes</h4>
                                </div>
                                <button type="button" class="btn btn-outline-purple float-right waves-effect waves-light"
                                    name="button" id="addButton" data-toggle="modal" data-target="#add"> Add
                                    New
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table id="attribuetable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($attributes))
                                            @foreach ($attributes as $attribute)
                                                <tr class="attribute{{ $attribute->feature_attribute_id }}">
                                                    <td>{{ $attribute->name }}</td>

                                                    <td>
                                                        <button type='button' class='btn btn-outline-info '
                                                            onclick='editAttribute({{ $attribute->feature_attribute_id }})'><i
                                                                class='mdi mdi-pencil'></i></button>
                                                        <button type='button' name='delete' class="btn btn-outline-danger "
                                                            onclick="deleteAttribute({{ $attribute->feature_attribute_id }})"><i
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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h5 class="modal-title mt-0 text-center">Add a new attribute</h5>
                    <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form class="attributeAddForm" method="POST"> @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Type name" />
                        </div>

                        <div class="form-group">
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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h5 class="modal-title mt-0 text-center">Update a attribute</h5>
                    <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form class="updateAttributeForm" method="POST"> @csrf @method('PUT')
                        <input type="hidden" name="hidden_id" id="hidden_id">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name" placeholder="Type name" />
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
            $('.attributeAddForm').trigger('reset');
        });

        $(document).ready(function() {
            $('#attribuetable').DataTable({
                "ordering": false,
            });

            // add form validation
            $(".attributeAddForm").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 100,
                    },

                },
                messages: {
                    name: {
                        required: 'Please insert attribute name',
                    },

                },
                errorPlacement: function(label, element) {
                    label.addClass('mt-2 text-danger');
                    label.insertAfter(element);
                },
            });
            // update form validation
            $(".updateAttributeForm").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 100,
                    },

                },
                messages: {
                    name: {
                        required: 'Please insert attribute name',
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
                updateStatus: "{!! route('category.status.update') !!}",
                add: "{!! route('feature-attributes.store') !!}",
                update: "{!! route('update.category') !!}",

            }
        };

        // store category 
        $(document).on('submit', '.attributeAddForm', function(event) {
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
                        var attribuetable = $('#attribuetable').DataTable();
                        var row = $('<tr>')
                            .append(`<td>` + response.data.attribute.name + `</td>`)


                            .append(`<td>
                            <button type='button' class='btn btn-outline-info' onclick='editAttribute(${response.data.attribute.feature_attribute_id})'>
                                <i class='mdi mdi-pencil'></i>
                            </button>
                            <button type='button'  name='delete' class="btn btn-outline-danger"onclick="deleteAttribute(${response.data.attribute.feature_attribute_id})">
                                <i class="mdi mdi-delete "></i>
                            </button>
                         </td>`)


                        var category_row = attribuetable.row.add(row).draw().node();
                        $('#attribuetable tbody').prepend(row);
                        $(category_row).addClass('attribute' + response.data.attribute.feature_attribute_id + '');
                        $('.attributeAddForm').trigger('reset');
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
                },

            });
        });


        //edit a category
        function editAttribute(id) {
            var url = "{!! route('feature-attributes.edit', ':id') !!}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                method: "get",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        $('#edit_name').val(response.data.name)
                        $('#hidden_id').val(response.data.feature_attribute_id)
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

        // update category
        $(document).off('submit', '.updateAttributeForm');
        $(document).on('submit', '.updateAttributeForm', function(event) {
            event.preventDefault();
            var id =   $('#hidden_id').val();

            var url = "{!! route('feature-attributes.update', ':id') !!}";
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                method: "post",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(response) {

                    if (response.success == true) {
                        $('.attribute' + response.data.attribute.feature_attribute_id).html(
                            `
                                <td>${response.data.attribute.name}</td>
                                <td>
                                    <button type='button' class='btn btn-outline-info' onclick='editAttribute(${response.data.attribute.feature_attribute_id})'>
                                        <i class='mdi mdi-pencil'></i>
                                    </button>
                                    <button type='button'  name='delete' class="btn btn-outline-danger"onclick="deleteAttribute(${response.data.attribute.feature_attribute_id})">
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
                            $('.updateAttributeForm')[0].reset();
                        }


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

                    }
                },

            });
        });


        // delete category
        function deleteAttribute(id) {
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
                    var delete_url = "{!! route('feature-attributes.destroy', ':id') !!}";
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
                                $('#attribuetable').DataTable().row('.attribute' + id)
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
                        },
                    });

                }
            })


        }
        //end
    </script>
@endsection
