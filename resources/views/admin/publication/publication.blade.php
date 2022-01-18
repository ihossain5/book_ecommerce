@extends('layouts.admin.master')
@section('title')
    Publications
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
                                    <h4 class="mt-0 header-title">All Publications</h4>
                                </div>
                                <button type="button" class="btn btn-outline-purple float-right waves-effect waves-light"
                                    name="button" id="addButton" data-toggle="modal" data-target="#add"> Add
                                    New
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table id="publicationtable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($publications))
                                            @foreach ($publications as $publication)
                                                <tr class="publication{{ $publication->publication_id }}">
                                                    <td>
                                                        <img class='img-fluid' src="{{ asset('images/' . $publication->photo) }}"
                                                            alt="{{ $publication->name }}" style='width: 60px; height: 55px;'>
                                                    </td>
                                                    <td>{{ $publication->name }}</td>
                                                    <td>{{ $publication->description }}</td>

                                                    <td>
                                                        <button type='button' class='btn btn-outline-dark'
                                                        onclick='viewPublication({{ $publication->publication_id }})'><i
                                                            class='fa fa-eye'></i>
                                                        </button>

                                                        <button type='button' class='btn btn-outline-info '
                                                            onclick='editPublication({{ $publication->publication_id }})'><i
                                                                class='mdi mdi-pencil'></i></button>

                                                        <button type='button' name='delete' class="btn btn-outline-danger "
                                                            onclick="deletePublication({{ $publication->publication_id }})"><i
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
                    <h5 class="modal-title mt-0 text-center">Add a new publication</h5>
                    <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form class="publicationAddForm" method="POST"> @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Type name" />
                        </div>
                        <div class="form-group">
                            <label>Precedance</label>
                            <input type="text" class="form-control" name="precedance" placeholder="Type precedance" />
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" cols="30" rows="5"></textarea>

                        </div>

                        <div class="form-group ">
                            <label for=""> Photo</label>
                            <div class="custom-file">
                                <input type="file" name="photo" class="custom-file-input dropify"
                                    data-errors-position="outside" data-allowed-file-extensions='["jpg", "png","jpeg"]'
                                    data-max-file-size="0.6M" data-height="120">
                            </div>
                            <label id="photo-error" class="error mt-2 text-danger" for="photo"></label>
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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h5 class="modal-title mt-0 text-center">Update a publication</h5>
                    <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form class="updatepublicationForm" method="POST"> @csrf @method('PUT')
                        <input type="hidden" name="hidden_id" id="hidden_id">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name" placeholder="Type name" />
                        </div>
                        <div class="form-group">
                            <label>Precedance</label>
                            <input type="text" class="form-control" id="edit_precedance" name="precedance" placeholder="Type precedance" />
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" id="edit_description" cols="30" rows="5"></textarea>

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
                    <h5 class="modal-title mt-0 text-center">Publication Details</h5>
                    <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-md-12">
                        <div class="ms-form-group view-modal">
                            <p class="pb-3">
                                <strong>Publication Name:</strong> <span id="view_name"></span><br>
                                <strong>Publication precedance:</strong> <span id="view_precedance"></span><br>
                                <strong>Publication Description:</strong> <span id="view_description"></span><br>
                                <strong>Publication Photo :</strong><br>
                                <img class="mt-2" src="" id="view_image" style="width: 100%;">
                            </p>
                        </div>
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
    <script>
        $('#addButton').on('click', function() {
            $('.publicationAddForm').trigger('reset');
            $('.dropify-preview').hide();
        });

        $(document).ready(function() {
            $('#publicationtable').DataTable({
                "ordering": false,
            });

            // add form validation
            $(".publicationAddForm").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 100,
                    },
                    description: {
                        required: true,
                        maxlength: 1000,
                    },
                    photo: {
                        required: true,
                    },
                    precedance: {
                        required: true,
                        digits: true,
                    },

                },
                messages: {
                    name: {
                        required: 'Please insert publication name',
                    },
                    description: {
                        required: 'Please insert publication description',
                    },
                    photo: {
                        required: 'Please insert publication photo',
                    },

                },
                errorPlacement: function(label, element) {
                    label.addClass('mt-2 text-danger');
                    label.insertAfter(element);
                },
            });
            // update form validation
            $(".updatepublicationForm").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 100,
                    },
                    precedance: {
                        required: true,
                        digits: true,
                    },
                    description: {
                        required: true,
                        maxlength: 1000,
                    },

                },
                messages: {
                    name: {
                        required: 'Please insert publication name',
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
                add: "{!! route('publications.store') !!}",
                edit: "{!! route('publications.edit', ':id') !!}",
                show: "{!! route('publications.show', ':id') !!}",
                update: "{!! route('publications.update', ':id') !!}",
                delete: "{!! route('publications.destroy', ':id') !!}",
            }
        };

        // store category 
        $(document).off('submit', '.publicationAddForm');
        $(document).on('submit', '.publicationAddForm', function(event) {
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
                        var publicationtable = $('#publicationtable').DataTable();
                        var row = $('<tr>')
                            .append(`<td><img class="img-fluid" src="${imagesUrl}` +
                                `${response.data.photo}" style='width: 60px; height: 55px;'></td>`)
                            .append(`<td>` + response.data.name + `</td>`)
                            .append(`<td>` + response.data.description + `</td>`)


                            .append(`<td>
                            <button type='button' class='btn btn-outline-dark' onclick='viewPublication(${response.data.publication_id})'>
                                  <i class='fa fa-eye'></i>
                             </button>
                            <button type='button' class='btn btn-outline-info' onclick='editPublication(${response.data.publication_id})'>
                                <i class='mdi mdi-pencil'></i>
                            </button>
                            <button type='button'  name='delete' class="btn btn-outline-danger"onclick="deletePublication(${response.data.publication_id})">
                                <i class="mdi mdi-delete "></i>
                            </button>
                         </td>`)


                        var publication_row = publicationtable.row.add(row).draw().node();
                        $('#publicationtable tbody').prepend(row);
                        $(publication_row).addClass('publication' + response.data.publication_id + '');
                        $('.publicationAddForm').trigger('reset');

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


        function viewPublication(id) {
            var url = config.routes.edit;
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
                        $('#view_name').text(response.data.name);
                        $('#view_precedance').text(response.data.precedance);
                        $('#view_description').text(response.data.description);

                        if (response.data.photo != null) {
                            $('#view_image').attr('src', imagesUrl + response.data.photo);
                        }
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
        function editPublication(id) {
            var url = config.routes.edit;
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
                        $('#edit_precedance').val(response.data.precedance)
                        $('#hidden_id').val(response.data.publication_id)

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
        $(document).off('submit', '.updatepublicationForm');
        $(document).on('submit', '.updatepublicationForm', function(event) {
            event.preventDefault();
            var id =   $('#hidden_id').val();

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
                        $('.publication' + response.data.publication_id).html(
                            `
                            <td>
                              <img class="img-fluid" src="${imagesUrl}` +`${response.data.photo}" style='width: 60px; height: 55px;'>
                            </td>
                                <td>${response.data.name}</td>
                                <td>${response.data.description}</td>
                                <td>
                                    <button type='button' class='btn btn-outline-dark' onclick='viewPublication(${response.data.publication_id})'>
                                       <i class='fa fa-eye'></i>
                                    </button>
                                    <button type='button' class='btn btn-outline-info' onclick='editPublication(${response.data.publication_id})'>
                                        <i class='mdi mdi-pencil'></i>
                                    </button>
                                    <button type='button'  name='delete' class="btn btn-outline-danger"onclick="deletePublication(${response.data.publication_id})">
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
                            $('.updatepublicationForm')[0].reset();
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

                    }else if (error.status == 500) {
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
        function deletePublication(id) {
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
                                $('#publicationtable').DataTable().row('.publication' + id)
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
    </script>
@endsection
