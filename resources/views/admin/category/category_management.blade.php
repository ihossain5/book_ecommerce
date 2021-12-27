@extends('layouts.admin.master')
@section('title')
    Category Management
@endsection
@section('pageCss')
    <style>
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
                                    <h4 class="mt-0 header-title">All Categories</h4>
                                </div>
                                <button type="button" class="btn btn-outline-purple float-right waves-effect waves-light"
                                    name="button" id="addButton" data-toggle="modal" data-target="#add"> Add
                                    New
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table id="categoryTable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Show to Homepage</th>
                                            <th>Show to Navbar</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($categories))
                                            @foreach ($categories as $category)
                                                <tr class="category{{ $category->category_id }}">
                                                    <td>{{ $category->name }}</td>

                                                    <td>{{ $category->description }}</td>

                                                    <td>
                                                        <label class="switch">
                                                            <input
                                                                class="is_home is_home_status{{ $category->category_id }}"
                                                                type="checkbox"
                                                                {{ $category->is_home == 1 ? 'checked' : '' }}
                                                                data-id="{{ $category->category_id }}">
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="switch">
                                                            <input
                                                                class="is_nav is_nav_status{{ $category->category_id }}"
                                                                type="checkbox"
                                                                {{ $category->is_nav == 1 ? 'checked' : '' }}
                                                                data-id="{{ $category->category_id }}">
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </td>

                                                    <td>

                                                        <button type='button' class='btn btn-outline-dark'
                                                            onclick='viewCategory({{ $category->category_id }})'><i
                                                                class='fa fa-eye'></i></button>
                                                        <button type='button' class='btn btn-outline-info '
                                                            onclick='editCategory({{ $category->category_id }})'><i
                                                                class='mdi mdi-pencil'></i></button>
                                                        <button type='button' name='delete' class="btn btn-outline-danger "
                                                            onclick="deleteCategory({{ $category->category_id }})"><i
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
                    <h5 class="modal-title mt-0 text-center">Add a new Category</h5>
                    <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form class="categoryAddForm" method="POST"> @csrf
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Type name" />
                        </div>
                        <div class="form-group">
                            <label>Category Description</label>
                            <textarea name="description" id="" class="form-control" cols="30" rows="5"></textarea>
                        </div>

                        
                        <div class="form-group ">
                            <label for=""> Photo</label>
                            <div class="custom-file">
                                <input type="file" name="photo" class="custom-file-input dropify"
                                    data-errors-position="outside" data-allowed-file-extensions='["jpg", "png","jpeg"]'
                                    data-max-file-size="0.3M" data-height="120">
                            </div>
                            <label id="photo-error" class="error mt-2 text-danger" for="photo"></label>
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
                    <h5 class="modal-title mt-0 text-center">Update a Category</h5>
                    <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form class="updateCategoryForm" method="POST"> @csrf
                        <input type="hidden" name="hidden_id" id="hidden_id">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name" placeholder="Type name" />
                        </div>
                        <div class="form-group">
                            <label>Category Description</label>
                            <textarea name="description" id="edit_description" class="form-control" cols="30"
                                rows="5"></textarea>
                        </div>
                        <div class="form-group ">
                            <label for=""> Photo</label>
                            <div class="custom-file edit_photo">
                                <input type="file" name="photo" class="custom-file-input dropify" id="edit_photo"
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
    <!-- view  Modal -->
    <div class="modal fade bs-example-modal-center" id="viewModal" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h5 class="modal-title mt-0 text-center">Category Details</h5>
                    <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-md-12">
                        <div class="ms-form-group">
                            <p class="pt-2 pb-2">
                                <strong>Name:</strong> <span id="view_name"></span><br>
                                <strong>Description:</strong> <span id="view_description"></span><br>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer view-modal-footer">
                    <button id="editBtn" type="button" data-dismiss="modal"
                        class="btn btn-block btn-primary waves-effect waves-light" onclick="editCategory()">
                        Edit
                    </button>
                    <button type="button" onclick="deleteCategory()"
                        class="btn btn-block delete_btn btn-danger waves-effect waves-light">
                        Delete
                    </button>
                    <button type="submit" data-dismiss="modal" class="btn btn-block btn-success waves-effect waves-light">
                        Done
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- view  Modal End -->
@endsection
@section('pageScripts')
    <script>
        $('#addButton').on('click', function() {
            $('.categoryAddForm').trigger('reset');
        });

        $(document).ready(function() {
            $('#categoryTable').DataTable({
                "ordering": false,
            });

            // add form validation
            $(".categoryAddForm").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 100,
                    },
                    description: {
                        required: true,
                        maxlength: 10000,
                    },
                    photo: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: 'Please insert category name',
                    },
                    description: {
                        required: 'Please insert category description',
                    },
                    photo: {
                        required: 'Please upload category photo',
                    },
                },
                errorPlacement: function(label, element) {
                    label.addClass('mt-2 text-danger');
                    label.insertAfter(element);
                },
            });
            // update form validation
            $(".updateCategoryForm").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 100,
                    },
                    description: {
                        required: true,
                        maxlength: 10000,
                    },
                },
                messages: {
                    name: {
                        required: 'Please insert category name',
                    },
                    description: {
                        required: 'Please insert category description',
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
                add: "{!! route('category.store') !!}",
                update: "{!! route('update.category') !!}",

            }
        };

        // store category 
        $(document).off('submit', '.categoryAddForm');
        $(document).on('submit', '.categoryAddForm', function(event) {
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
                        var categoryTable = $('#categoryTable').DataTable();
                        var row = $('<tr>')
                            .append(`<td>` + response.data.category.name + `</td>`)
                            .append(`<td>` + response.data.category.description + `</td>`)
                            .append(`<td>
                                        <label class="switch">
                                                <input class="is_home is_home_status${ response.data.category.category_id}"type="checkbox"
                                                   data-id="${response.data.category.category_id}">
                                                      <span class="slider round"></span>
                                         </label>
                                         </td>`)
                            .append(`<td>
                                        <label class="switch">
                                                <input class="is_nav is_nav_status${ response.data.category.category_id}"type="checkbox"
                                                   data-id="${response.data.category.category_id}">
                                                      <span class="slider round"></span>
                                         </label>
                                         </td>`)

                            .append(`<td>
                                <button type='button' class='btn btn-outline-dark' onclick='viewCategory(${response.data.category.category_id})'>
                                <i class='fa fa-eye'></i>
                            </button>
                            <button type='button' class='btn btn-outline-info' onclick='editCategory(${response.data.category.category_id})'>
                                <i class='mdi mdi-pencil'></i>
                            </button>
                            <button type='button'  name='delete' class="btn btn-outline-danger"onclick="deleteCategory(${response.data.category.category_id})">
                                <i class="mdi mdi-delete "></i>
                            </button>
                         </td>`)


                        var category_row = categoryTable.row.add(row).draw().node();
                        $('#categoryTable tbody').prepend(row);
                        $(category_row).addClass('category' + response.data.category.category_id + '');
                        $('.categoryAddForm').trigger('reset');
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
        function editCategory(id) {
            var url = "{!! route('category.edit', ':id') !!}";
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
                        $('#edit_description').val(response.data.description)
                        $('#hidden_id').val(response.data.category_id)

                        if (response.data.photo) {
                            var photo = imagesUrl + response.data.photo;
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
        $(document).off('submit', '.updateCategoryForm');
        $(document).on('submit', '.updateCategoryForm', function(event) {
            event.preventDefault();

            $.ajax({
                url: config.routes.update,
                method: "post",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(response) {

                    if (response.success == true) {
                        $('.category' + response.data.category.category_id).html(
                            `
                                <td>${response.data.category.name}</td>
                                <td>${response.data.category.description}</td>

                                <td>
                                        <label class="switch">
                                                <input class="is_home is_home_status${ response.data.category.category_id}"type="checkbox"
                                                ${response.data.category.is_home == 1 ? 'checked' : ''}  data-id="${response.data.category.category_id}">
                                                      <span class="slider round"></span>
                                         </label>
                                </td>
                                <td>
                                        <label class="switch">
                                                <input class="is_nav is_nav_status${ response.data.category.category_id}"type="checkbox"
                                                ${response.data.category.is_nav == 1 ? 'checked' : ''}   data-id="${response.data.category.category_id}">
                                                      <span class="slider round"></span>
                                         </label>
                                         </td>
                                  
                                         <td>
                                <button type='button' class='btn btn-outline-dark' onclick='viewCategory(${response.data.category.category_id})'>
                                <i class='fa fa-eye'></i>
                            </button>
                            <button type='button' class='btn btn-outline-info' onclick='editCategory(${response.data.category.category_id})'>
                                <i class='mdi mdi-pencil'></i>
                            </button>
                            <button type='button'  name='delete' class="btn btn-outline-danger"onclick="deleteCategory(${response.data.category.category_id})">
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
                            $('.updateCategoryForm')[0].reset();
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

        // is home status change function
        $(document.body).on('click', '.is_home', function() {
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
                            type: 'is_home',
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
                    if ($('.is_home_status' + id + "").prop("checked") == true) {
                        $('.is_home_status' + id + "").prop('checked', false);
                    } else {
                        $('.is_home_status' + id + "").prop('checked', true);
                    }
                }
            })
        });

        // is nav status change function
        $(document.body).on('click', '.is_nav', function() {
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
                            type: 'is_nav',
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
                    if ($('.is_nav_status' + id + "").prop("checked") == true) {
                        $('.is_nav_status' + id + "").prop('checked', false);
                    } else {
                        $('.is_nav_status' + id + "").prop('checked', true);
                    }
                }
            })
        });


        // delete category
        function deleteCategory(id) {
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
                    var delete_url = "{!! route('category.destroy', ':id') !!}";
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
                                $('#categoryTable').DataTable().row('.category' + id)
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
