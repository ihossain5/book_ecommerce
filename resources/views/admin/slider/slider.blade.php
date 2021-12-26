@extends('layouts.admin.master')
@section('title', 'Slider')
@section('pageCss')
<style>
     .view_employee_signature {
        max-height: 220px;
        max-width: 467px;
    }
</style>
@endsection
@section('content')
<div class="preloader">

</div>

<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-4">
                            <div class="ms-header-text">
                                <h4 class="mt-0 header-title">Slider</h4>
                            </div>

                            <button type="button" class="btn btn-outline-purple float-right waves-effect waves-light"
                                name="button" id="addButton" data-toggle="modal" data-target="#addSliderModal"> Add
                                New
                            </button>
                        </div>
                        <span class="showError"></span>
                        <div class="table-responsive">
                        <table id="slider_Table" class="table table-bordered dt-responsive nowrap"
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
                                <tr class="slider_class{{ $slider->id }}">
                                    <td>{{ $slider->precedence ?? 'N/A' }}</td>
                                    <td><img class="img-fluid" src="{{ asset('images/' . $slider->image) }}"
                                            style="width: 60px; height: 55px;"></td>
                                    <td>{{ $slider->title ?? 'N/A' }}</td>
                                    <td>{!!$slider->description ?? 'N/A'!!}</td>
                                    <td class="actionBtn text-center">
                                        <button type='button' class='btn btn-outline-purple'
                                            onclick='viewSlider({{ $slider->id }})'><i
                                                class='fa fa-eye'></i></button>
                                        <button type='button' class='btn btn-outline-purple '
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
<div class="modal fade bs-example-modal-center" id="addSliderModal" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-block">
                <h5 class="modal-title mt-0 text-center">Add a new Slider</h5>
                <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="sliderAddForm" method="POST"> @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="add_title" placeholder="Type title" />
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="add_description" class="form-control" placeholder="Type description"
                            id="add_description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Precedence</label>
                        <input type="text" class="form-control" name="add_precedence" placeholder="Type precedence" />
                    </div>
                    <div class="form-group ">
                        <label>Image (max: 600 KB) (image size: )</label>
                        <div class="custom-file">
                             <div class="custom-file">
                                <input type="file" name="add_photo" class="custom-file-input dropify"
                                    data-errors-position="outside" data-allowed-file-extensions='["jpg", "png","jpeg"]'
                                    data-max-file-size="0.6M" data-height="120">
                            </div>
                        </div>
                        <label id="add_photo-error" class="error mt-2 text-danger" for="add_photo"></label>
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
                <h5 class="modal-title mt-0 text-center">Update Slider</h5>
                <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="updateSliderForm" method="POST"> @csrf
                    <input type="hidden" name="hidden_id" id="hidden_id">

                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" id="edit_title" name="edit_title"
                            placeholder="Type title" />
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="edit_description" class="form-control" placeholder="Type description"
                            id="edit_description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Precedence</label>
                        <input type="text" class="form-control" id="edit_precedence" name="edit_precedence"
                            placeholder="Type precedence" />
                    </div>
                    <div class="form-group ">
                        <label>Image (max: 600 KB) (image size: )</label>
                        <div class="custom-file big_image">
                            
                                <input type="file" id="edit_photo" name="edit_photo" class="custom-file-input dropify"
                                    data-errors-position="outside" data-allowed-file-extensions='["jpg","jpeg", "png"]'
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
                <h5 class="modal-title mt-0 text-center">Slider Details</h5>
                <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="col-xl-12 col-md-12">
                    <div class="ms-form-group">
                        <label for="view_heading"><strong>Title</strong></label>
                        <p id="view_heading"></p>
                    </div>
                </div>
                <div class="col-xl-12 col-md-12">
                    <div class="ms-form-group">
                        <label for="description"><strong>Description</strong></label>
                        <p id="view_description"></p>
                    </div>
                </div>
                <div class="col-xl-12 col-md-12">
                    <div class="ms-form-group">
                        <label for="precedence"><strong>Precedence</strong></label>
                        <p id="view_precedence"></p>
                    </div>
                </div>
                <div class="col-xl-12 col-md-12">
                    <label for="photo"><strong>Photo</strong></label>
                    <div class="ms-form-group" >
                        <img src="" id="view_photo" class="view_employee_signature">
                    </div>
                </div>
                <br>
                <div>
                    <button type="submit" class="btn btn-block btn-success waves-effect waves-light"
                        data-dismiss="modal" aria-hidden="true">
                        Done
                    </button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- view  Modal End -->
@endsection
@section('pageScripts')
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script type='text/javascript'>
    var toastMixin = Swal.mixin({
        toast: true
        , title: 'General Title'
        , animation: false
        , position: 'top-right'
        , showConfirmButton: false
        , timer: 5000
        , timerProgressBar: true
        , didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
    var config = {
        routes: {
            add: "{!! route('sliders.store') !!}"
            , edit: "{!! route('sliders.edit') !!}"
            , update: "{!! route('sliders.update') !!}"
            , delete: "{!! route('sliders.delete') !!}"
        , }
    };

    $('#addButton').on('click', function() {
        $('.dropify-preview').hide();
        $('.sliderAddForm').trigger('reset');
    });

    var path = "{{ url('/') }}" + '/images';
  
    $(document).ready(function() {
        $('#slider_Table').DataTable({
            "ordering": false,
        });
        $('.dropify').dropify();

        //$('#slider_Table tfoot tr').prependTo('#slider_Table thead');
        //$('.loader').hide();

        // CKEDITOR.replace('add_description');
        // CKEDITOR.replace('edit_description');

    });



    // add form validation
    $(document).ready(function() {
        $(".sliderAddForm").validate({
            rules: {
                add_title: {
                    required: true,
                    maxlength: 100,
                },
                add_description: {
                    required: true,
                    maxlength: 2000,
                },

                add_photo: {
                    required: true,
                },
                add_precedence: {
                    digits: true,
                },
            },
            messages: {
                add_title: {
                    required: 'Please insert title',
                },
                add_description: {
                    required: 'Please insert description',
                },
                add_photo: {
                    required: 'Please upload photo',
                },
            },
            errorPlacement: function(label, element) {
                label.addClass('mt-2 text-danger');
                label.insertAfter(element);
            },
        });
    });
    //end

    // add  request

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
                    var slider_Table = $('#slider_Table').DataTable();
                    var row = $('<tr>')
                        .append((response.data.precedence == null ? '`<td> N/A </td>`' : '`<td>' + response.data.precedence + '</td>`'))
                        .append(
                            `<td><img class="img-fluid" src="${path+'/'+response.data.image}" style='width: 60px; height: 55px;'></td>`
                        )
                        .append(`<td>` + response.data.title + `</td>`)
                        .append(`<td>` + response.data.description?? 'N/A' + `</td>`)
                        .append(`<td><button type='button' class='btn btn-outline-purple' onclick='viewSlider(${response.data.id})'>
                                <i class='fa fa-eye'></i>
                            </button>
                            <button type='button' class='btn btn-outline-purple' onclick='editSlider(${response.data.id})'>
                                <i class='mdi mdi-pencil'></i>
                            </button>

                            <button type='button'  name='delete' class="btn btn-outline-danger"onclick="deleteSlider(${response.data.id})">
                                <i class="mdi mdi-delete "></i>
                            </button></td>`)

                   
                    var slider_class_row = slider_Table.row.add(row).draw().node();
                    $('#slider_Table tbody').prepend(row);
                    $(slider_class_row).addClass('slider_class' + response.data.id + '');
                    $('.sliderAddForm').trigger('reset');
                    if (response.data.message) {
                        $('#addSliderModal').modal('hide');
                        toastMixin.fire({
                            icon: 'success'
                            , animation: true
                            , title: "" + response.data.message + ""
                        });
                    }
                } else {
                    toastMixin.fire({
                        icon: 'error',
                        animation: true,
                        title: "" + response.data.error + "",
                    });
                }
            }, //success end
        });
    });

    //request end

    var path = "{{ url('/') }}" + '/images/';
    // view single
    function viewSlider(id) {
        $.ajax({
            url: config.routes.edit
            , method: "POST"
            , data: {
                id: id
                , _token: "{{ csrf_token() }}"
            }
            , dataType: "json"
            , success: function(response) {
                //alert("success");
                if (response.success == true) {
                    var photo_url = path + response.data.image;

                    $("#view_photo").attr("src", photo_url);

                    $('#view_heading').text(response.data.title);
                    $('#view_description').html(response.data.description);
                    $('#view_precedence').html(response.data.precedence);
                    $('#viewModal').modal('show');

                } //success end

            }
        }); //ajax end
    }




    // Update product
    //validation
    $(document).ready(function() {
        $(".updateSliderForm").validate({
            rules: {
                edit_title: {
                    required: true,
                    maxlength: 100,
                },
                edit_description: {
                    required: true,
                    maxlength: 2000,
                },
                edit_precedence: {
                    digits: true,
                },
            },
            messages: {
                edit_title: {
                    required: 'Please insert title',
                },
                edit_description: {
                    required: 'Please insert description',
                },
            },
            errorPlacement: function(label, element) {
                label.addClass('mt-2 text-danger');
                label.insertAfter(element);
            },
        });
    });


    function editSlider(id) {
        $.ajax({
            url: config.routes.edit
            , method: "POST"
            , data: {
                id: id
                , _token: "{{ csrf_token() }}"
            }
            , dataType: "json"
            , success: function(response) {
                if (response.success == true) {
                    $('#edit_precedence').val(response.data.precedence)
                    $('#edit_title').val(response.data.title)
                    $('#edit_description').val(response.data.description)
                    // try {
                    //     CKEDITOR.instances['edit_description'].destroy(true);
                    // } catch (e) {}
                    //     CKEDITOR.replace('edit_description');

                    $('#hidden_id').val(response.data.id);

                    if (response.data.image) {
                        var image_url = path + response.data.image;
                        $("#edit_photo").attr("data-height", 100);
                        $("#edit_photo").attr("data-default-file", image_url);

                        $('.big_image').find('.dropify-wrapper').removeClass("dropify-wrapper").addClass("dropify-wrapper has-preview");
                        $('.big_image').find(".dropify-preview").css('display', 'block');
                        $('.big_image').find('.dropify-render').html('').html('<img src=" ' + image_url +
                            '">')
                    } else {
                        $('#edit_photo').find(".dropify-preview .dropify-render img").attr("src", "");
                    }



                    $('#edit_modal').modal('show');

                } //success end

            }
        });
        $(document).off('submit', '.updateSliderForm');
        $(document).on('submit', '.updateSliderForm', function(event) {
            event.preventDefault();
            $.ajax({
                url: config.routes.update
                , method: "POST"
                , data: new FormData(this)
                , contentType: false
                , cache: false
                , processData: false
                , dataType: "json"
                , success: function(response) {

                    if (response.success == true) {
                        $('.slider_class' + response.data.id).html(
                            `
                                <td>${response.data.precedence ?? 'N/A'}</td>
								<td><img class="img-fluid" src="${path+'/'+response.data.image}" style='width: 60px; height: 55px;'></td>

                                <td>${response.data.title}</td>
                                <td>${response.data.description}</td>
                                <td><button type='button' class='btn btn-outline-purple' onclick='viewSlider(${response.data.id})'>
                                <i class='fa fa-eye'></i>
                            </button>
                            <button type='button' class='btn btn-outline-purple' onclick='editSlider(${response.data.id})'>
                                <i class='mdi mdi-pencil'></i>
                            </button>

                            <button type='button'  name='delete' class="btn btn-outline-danger"onclick="deleteSlider(${response.data.id})">
                                <i class="mdi mdi-delete "></i>
                            </button></td>
                                `
                        );

                        if (response.data.message) {
                            $('#edit_modal').modal('hide');
                            toastMixin.fire({
                                icon: 'success'
                                , animation: true
                                , title: "" + response.data.message + ""
                            });
                            $('.updateSliderForm')[0].reset();
                        }
                    } else {

                        toastMixin.fire({
                            icon: 'error'
                            , animation: true
                            , title: "" + response.data.error + ""
                        });

                    }

                }, //success end
            });
        });

    }

    // delete slider
    function deleteSlider(id) {
        // alert(id)
        Swal.fire({
            title: 'Are you sure?'
            , text: "You won't be able to revert this!"
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#3085d6'
            , cancelButtonColor: '#d33'
            , confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST"
                    , url: config.routes.delete
                    , data: {
                        id: id
                        , _token: "{{ csrf_token() }}"
                    }
                    , dataType: 'JSON'
                    , success: function(response) {
                        if (response.success === true) {
                            Swal.fire(
                                'Deleted!'
                                , "" + response.data.message + ""
                                , 'success'
                            )
                            // swal("Done!", response.data.message, "success");
                            $('#slider_Table').DataTable().row('.slider_class' + response.data.id)
                                .remove()
                                .draw();
                        } else {
                            Swal.fire("Error!", "" + response.message + "", "error");
                        }
                    }
                });

            }
        })


    }
    //end
</script>
@endsection