@extends('layouts.admin.master')
@section('title')
    Slider Management
@endsection
@section('pageCss')
    <style>
        .viewBookModalData label>span {
            font-weight: 400;
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
                                    <h4 class="mt-0 header-title">All sliders</h4>
                                </div>
                                <button type="button" class="btn btn-outline-purple float-right waves-effect waves-light"
                                    name="button" id="addButton" data-toggle="modal" data-target="#add"> Add
                                    New
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table id="sliderTable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Precedence</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($sliders))
                                            @foreach ($sliders as $slider)
                                                <tr class="slider{{ $slider->id }}">
                                                    <td>{{ $slider->precedence }}</td>
                                                    <td>
                                                        <img class='img-fluid'
                                                            src="{{ asset('images/' . $slider->image) }}"
                                                            alt="{{ $slider->name }}" style='width: 60px; height: 55px;'>
                                                    </td>
                                                    <td>{{ $slider->title }}</td>
                                                    <td>{{ $slider->formated_description }}</td>

                                                    <td>
                                                        <button type='button' class='btn btn-outline-dark'
                                                            onclick='viewSlider({{ $slider->id }})'><i
                                                                class='fa fa-eye'></i>
                                                        </button>

                                                        <button type='button' class='btn btn-outline-info '
                                                            onclick='editSlider({{ $slider->id }})'><i
                                                                class='mdi mdi-pencil'></i></button>

                                                        <button type='button' name='delete' class="btn btn-outline-danger "
                                                            onclick="deleteSlider({{ $slider->id }})"><i
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
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h5 class="modal-title mt-0 text-center">Add a new slider</h5>
                    <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form class="sliderAddForm" method="POST"> @csrf
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Type title" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Precedence </label>
                                    <input type="text" class="form-control" name="precedence"
                                        placeholder="Type precedence number" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" cols="30" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label for=""> Photo</label>
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input dropify"
                                            data-errors-position="outside"
                                            data-allowed-file-extensions='["jpg", "png","jpeg"]' data-max-file-size="0.6M"
                                            data-height="120">
                                    </div>
                                    <label id="image-error" class="error mt-2 text-danger" for="image"></label>
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
                    <h5 class="modal-title mt-0 text-center">Update a slider</h5>
                    <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form class="updatesliderForm" method="POST"> @csrf @method('PUT')
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
                                    <label>Precedence </label>
                                    <input type="text" class="form-control" id="edit_precedence" name="precedence"
                                        placeholder="Type precedence number" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" id="edit_description" class="form-control" cols="30"
                                        rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label for=""> Photo</label>
                                    <div class="custom-file image">
                                        <input type="file" name="image" class="custom-file-input" id="edit_image"
                                            data-errors-position="outside"
                                            data-allowed-file-extensions='["jpg", "png","jpeg"]' data-max-file-size="0.6M"
                                            data-height="120">
                                    </div>
                                    <label id="image-error" class="error mt-2 text-danger" for="image"></label>
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
                    <h5 class="modal-title mt-0 text-center">Slider Details</h5>
                    <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-md-12">

                        <div class="form-row">
                            <div class="col-md-12">
                                <img class="mt-2" src="" id="view_image" style="width: 100%;">
                            </div>
                        </div>

                        <div class="form-row mt-4 viewBookModalData">
                            <div class="col-md-6">
                                <label> Title : <span class="title"></span></label>
                            </div>
                            <div class="col-md-6">
                                <label> Description : <span class="view_description"></span></label>
                            </div>
                            <div class="col-md-6">
                                <label> Precedence : <span class="view_precedence"></span></label>
                            </div>

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
            $('.sliderAddForm').trigger('reset');
            $('.dropify-preview').hide();

        });

        $(document).ready(function() {
            $('#sliderTable').DataTable({
                "ordering": false,
            });

            // add form validation
            $(".sliderAddForm").validate({

                rules: {
                    title: {
                        required: true,
                        maxlength: 100,
                    },
                    precedence: {
                        required: true,
                        maxlength: 100,
                    },
                    description: {
                        required: true,
                        maxlength: 1000,
                    },
                    image: {
                        required: true,
                    },


                },
                messages: {
                    title: {
                        required: 'Please insert slider title',
                    },
                    precedence: {
                        required: 'Please insert precedence number',
                    },
                    description: {
                        required: 'Please insert description',
                    },
                    image: {
                        required: 'Please upload image',
                    },


                },

                errorPlacement: function(label, element) {
                    label.addClass('mt-2 text-danger');
                    label.insertAfter(element);
                },
            });
            // update form validation
            $(".updatesliderForm").validate({
                rules: {
                    title: {
                        required: true,
                        maxlength: 100,
                    },
                    precedence: {
                        required: true,
                        maxlength: 100,
                    },
                    description: {
                        required: true,
                        maxlength: 1000,
                    },

                },
                messages: {
                    title: {
                        required: 'Please insert slider title',
                    },
                    precedence: {
                        required: 'Please insert precedence number',
                    },
                    description: {
                        required: 'Please insert description',
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
                add: "{!! route('sliders.store') !!}",
                edit: "{!! route('sliders.edit', ':id') !!}",
                update: "{!! route('sliders.update', ':id') !!}",
                delete: "{!! route('sliders.destroy', ':id') !!}",

            }
        };

        // store category 
        $(document).off('submit', '.sliderAddForm');
        $(document).on('submit', '.sliderAddForm', function(event) {
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
                        var sliderTable = $('#sliderTable').DataTable();
                        var row = $('<tr>')
                            .append(`<td>` + response.data.precedence + `</td>`)
                            .append(`<td><img class="img-fluid" src="${imagesUrl}` +
                                `${response.data.image}" style='width: 60px; height: 55px;'></td>`
                            )
                            .append(`<td>` + response.data.title + `</td>`)
                            .append(`<td>` + response.data.description + `</td>`)

                            .append(`<td>
                            <button type='button' class='btn btn-outline-dark' onclick='viewSlider(${response.data.id})'>
                                  <i class='fa fa-eye'></i>
                             </button>
                            <button type='button' class='btn btn-outline-info' onclick='editSlider(${response.data.id})'>
                                <i class='mdi mdi-pencil'></i>
                            </button>
                            <button type='button'  name='delete' class="btn btn-outline-danger"onclick="deleteSlider(${response.data.id})">
                                <i class="mdi mdi-delete "></i>
                            </button>
                         </td>`)


                        var slider_row = sliderTable.row.add(row).draw().node();
                        $('#sliderTable tbody').prepend(row);
                        $(slider_row).addClass('slider' + response.data.id + '');
                        $('.sliderAddForm').trigger('reset');

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


        function viewSlider(id) {
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

                        if (response.data.image != null) {
                            $('#view_image').attr('src', imagesUrl + response.data.image);
                        }

                        $('.view_description').html(response.data.description)
                        $('.view_precedence').html(response.data.precedence)


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
        function editSlider(id) {
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
                        $('#edit_precedence').val(response.data.precedence)
                        $('#edit_description').val(response.data.description)
                        $('#hidden_id').val(response.data.id)

                        //image start
                        if (response.data.image) {
                            var image = response.data.image;
                            var imageId = '#edit_image';
                            var imageClass = '.image';
                            var location = '/images/';
                            showImageIntoModal(image, imageId, imageClass, location)
                        } else {
                            $('.image').find(".dropify-preview .dropify-render img").attr("src", "");
                        }
                        //image end

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

        function showImageIntoModal(image, imageId, imageClass, location_path) {
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
        $(document).off('submit', '.updatesliderForm');
        $(document).on('submit', '.updatesliderForm', function(event) {
            event.preventDefault();
            var id = $('#hidden_id').val();


            var update_url = config.routes.update;
            update_url = update_url.replace(':id', id);

            console.log(config.routes.update);

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
                        $('.slider' + response.data.id).html(
                            `
                            <td>${response.data.precedence}</td>
                            <td>
                              <img class="img-fluid" src="${imagesUrl}` + `${response.data.image}" style='width: 60px; height: 55px;'>
                            </td>
                                <td>${response.data.title}</td>
                                <td>${response.data.description}</td>


                                <td>
                                    <button type='button' class='btn btn-outline-dark' onclick='viewSlider(${response.data.id})'>
                                       <i class='fa fa-eye'></i>
                                    </button>
                                    <button type='button' class='btn btn-outline-info' onclick='editSlider(${response.data.id})'>
                                        <i class='mdi mdi-pencil'></i>
                                    </button>
                                    <button type='button'  name='delete' class="btn btn-outline-danger"onclick="deleteSlider(${response.data.id})">
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
                            $('.updatesliderForm')[0].reset();
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
        function deleteSlider(id) {
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
                                $('#sliderTable').DataTable().row('.slider' + id)
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

        function readslider(id) {
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
