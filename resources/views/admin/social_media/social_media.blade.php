@extends('layouts.admin.master')
@section('title', 'Social Media')
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
								<h4 class="mt-0 header-title">Social Media</h4>
							</div>

							<button type="button" class="btn btn-outline-purple float-right waves-effect waves-light"
								name="button" id="addButton" data-toggle="modal" data-target="#SocialMediaAddModal"> Add
								New
							</button>
						</div>
						<span class="showError"></span>
                        <div class="table-responsive">
						<table id="social_MediaTable" class="table table-bordered dt-responsive nowrap"
							style="border-collapse: collapse; border-spacing: 0; width: 100%;">
							<thead>
								<tr>
                                    <th>Logo</th>
									<th>Name</th>
									<th>Url</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@if (!empty($social_medias))
								@foreach ($social_medias as $social_media)
								<tr class="SocialMediaClass{{ $social_media->id }}">
									<td><img class="img-fluid" src="{{ asset('images/' .$social_media->logo) }}"
										style="width: 60px; height: 55px;"></td>
                                    <td>{{ $social_media->name}}</td>
                                    <td><a href="{{$social_media->url}}">{{explode("/",$social_media->url)[2]??'N/A'}}</a></td>
									<td class="actionBtn text-center">
										<button type='button' class='btn btn-outline-purple'
											onclick='viewSocialMedia({{ $social_media->id }})'><i class='fa fa-eye'></i></button>
										<button type='button' class='btn btn-outline-purple '
											onclick='editSocialMedia({{ $social_media->id }})'><i
												class='mdi mdi-pencil'></i></button>
										<button type='button' name='delete' class="btn btn-outline-danger "
											onclick="deleteSocialMedia({{ $social_media->id }})"><i
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
<div class="modal fade bs-example-modal-center" id="SocialMediaAddModal" tabindex="-1" role="dialog"
	aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header d-block">
				<h5 class="modal-title mt-0 text-center">Add Social Media</h5>
				<button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
				<form class="SocialMediaAddForm" method="POST"> @csrf
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" name="add_name" placeholder="Type name" />
					</div>
					<div class="form-group">
						<label>Url</label>
						<textarea name="add_url" class="form-control" placeholder="https://www.example.com/"
							id="add_url"></textarea>
					</div>
        
					<div class="form-group">
						<label>Logo (max: 600 KB) (size: )</label>
						<div class="custom-file">
							<input type="file" name="add_photo" class="custom-file-input dropify"
                                data-errors-position="outside" data-allowed-file-extensions='["jpeg", "jpg", "png"]'
                                data-max-file-size="0.6M" data-height="120">
						</div>
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
				<h5 class="modal-title mt-0 text-center">Update Social Media</h5>
				<button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
				<form class="SocialMediaUpdateForm" method="POST"> @csrf
					<input type="hidden" name="hidden_id" id="hidden_id">

					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" id="edit_name" name="edit_name" placeholder="Type name" />
					</div>
					<div class="form-group">
						<label>Url</label>
						<textarea name="edit_url" class="form-control" placeholder="https://www.example.com/embed/yyyyyyy"
							id="edit_url"></textarea>
					</div>
					<div class="form-group">
						<label>Logo (max: 600 KB) (size: )</label>
						<div class="custom-file circular_pdf">
							<input type="file" name="edit_photo" class="custom-file-input dropify"
                                data-errors-position="outside" data-allowed-file-extensions='["jpeg", "jpg", "png"]'
                                data-max-file-size="0.6M" data-height="120" >
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
				<h5 class="modal-title mt-0 text-center">Social Media Details</h5>
				<button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">


				<div class="col-xl-12 col-md-12">
					<div class="ms-form-group">
						<label for="view_name"><strong>Name</strong></label>
						<p id="view_name"></p>
					</div>
				</div>

				<div class="col-xl-12 col-md-12">
					<div class="ms-form-group">
						<label for="link"><strong>URL</strong></label>
						<p><span > <a id="view_url"></a> </span> </p>
					</div>
				</div>
                
				<div class="col-xl-12 col-md-12">
                    <label for="photo"><strong>Logo</strong></label>
                    <div class="ms-form-group">
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

<script type='text/javascript'>
	var toastMixin = Swal.mixin({
            toast: true,
            title: 'General Title',
            animation: false,
            position: 'top-right',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        var config = {
            routes: {
                add: "{!! route('socials.store') !!}",
                edit: "{!! route('socials.edit') !!}",
                update: "{!! route('socials.update') !!}",
                delete: "{!! route('socials.delete') !!}",
            }
        };

        $('#addButton').on('click', function() {
            $('.dropify-preview').hide();
            $('.SocialMediaAddForm').trigger('reset');
        });

        var path = "{{ url('/') }}" + '/images';

        $(document).ready(function() {
            $('#social_MediaTable').DataTable({
                "ordering": false,
            });
            $('.dropify').dropify();

            // $('#social_MediaTable tfoot tr').prependTo('#social_MediaTable thead');
            // $('.loader').hide();

        });

        // add form validation
        $(document).ready(function() {
            $(".SocialMediaAddForm").validate({
                rules: {
                    add_name: {
                        required: true,
                    },
                    add_url: {
                        required: true,
                        maxlength: 2000,
                        url: true,
                    },
                    add_description: {
                        required: true,
                        maxlength: 2000,
                    },
                    add_date: {
                        required: true,
                    },

                    add_photo: {
                        required: true,
                    },
                },
                messages: {
                    add_name: {
                        required: 'Please insert name',
                    },

                    add_url: {
                        required: 'Please insert link',
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

        $(document).on('submit', '.SocialMediaAddForm', function(event) {
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
                        var social_MediaTable = $('#social_MediaTable').DataTable();
                        var row = $('<tr>')
                            .append(
                                `<td><img class="img-fluid" src="${path+'/'+response.data.logo}" style='width: 60px; height: 55px;'></td>`
                                )
                            .append(`<td>` + response.data.name + `</td>`)
                            .append(`<td><a href="${response.data.url}">${response.data.explode_url}</a></td>`)

                           

                            .append(`<td><button type='button' class='btn btn-outline-purple' onclick='viewSocialMedia(${response.data.id})'>
                                <i class='fa fa-eye'></i>
                            </button>
                            <button type='button' class='btn btn-outline-purple' onclick='editSocialMedia(${response.data.id})'>
                                <i class='mdi mdi-pencil'></i>
                            </button>

                            <button type='button'  name='delete' class="btn btn-outline-danger"onclick="deleteSocialMedia(${response.data.id})">
                                <i class="mdi mdi-delete "></i>
                            </button></td>`)


                        var SocialMediaClass_row = social_MediaTable.row.add(row).draw().node();
                        $('#social_MediaTable tbody').prepend(row);
                        $(SocialMediaClass_row).addClass('SocialMediaClass' + response.data.id + '');

                        // $(trDOM).addClass('SocialMediaClass' + response.data.id + '');
                        $('.SocialMediaAddForm').trigger('reset');
                        if (response.data.message) {
                            $('#SocialMediaAddModal').modal('hide');
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
            });
        });

        //request end

        var path = "{{ url('/') }}" + '/images/';
        // view single
        function viewSocialMedia(id) {
            $.ajax({
                url: config.routes.edit,
                method: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    //alert("success");
                    if (response.success == true) {

                    var photo_url = path + response.data.image;
                        $('#view_name').text(response.data.name);
                        $("#view_url").attr("href",response.data.url).text(response.data.url);
						if (response.data.logo === null) {
                            $('#view_photo').removeAttr('src');
                        } else {
                            $('#view_photo').attr('src', '/images/' + response.data.logo);
                        }
                        $('#viewModal').modal('show');

                    } //success end

                }
            }); //ajax end
        }




        // Update product
        //validation
        $(document).ready(function() {
            $(".SocialMediaUpdateForm").validate({
                rules: {
                    edit_name: {
                        required: true,
                    },
                    edit_url: {
                        required: true,
                        maxlength: 2000,
                        url: true,
                    },
                },
                messages: {
                    edit_name: {
                        required: 'Please insert name',
                    },

                    edit_url: {
                        required: 'Please insert link',
                    },
                },
                errorPlacement: function(label, element) {
                    label.addClass('mt-2 text-danger');
                    label.insertAfter(element);
                },
            });
        });


        function editSocialMedia(id) {
            $.ajax({
                url: config.routes.edit,
                method: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        $('#edit_name').val(response.data.name)
                        $('#edit_url').val(response.data.url)
                        $('#hidden_id').val(response.data.id)
                        if (response.data.logo) {
                            var logo_url = path + response.data.logo;
                            $("#edit_photo").attr("data-height", 150);
                            $("#edit_photo").attr("data-min-width", 450);
                            $("#edit_photo").attr("data-default-file", logo_url);
                            $(".dropify-wrapper").removeClass("dropify-wrapper").addClass(
                                "dropify-wrapper has-preview");
                            $(".dropify-preview").css('display', 'block');
                            $('.dropify-render').html('').html('<img src=" ' + logo_url +
                                '">')
                        } else {
                            $(".dropify-preview .dropify-render img").attr("src", "");
                        }

                        $('#edit_modal').modal('show');

                    } //success end

                }
            });
            $(document).off('submit', '.SocialMediaUpdateForm');
            $(document).on('submit', '.SocialMediaUpdateForm', function(event) {
                event.preventDefault();
                $.ajax({
                    url: config.routes.update,
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(response) {

                        if (response.success == true) {
                            $('.SocialMediaClass' + response.data.id).html(
                                `
                                <td><img class="img-fluid" src="${path+'/'+response.data.logo}" style='width: 60px; height: 55px;'></td>
                                <td>${response.data.name}</td>
                                <td><a href="${response.data.url}">${response.data.explode_url}</a></td>
                               

                                <td><button type='button' class='btn btn-outline-purple' onclick='viewSocialMedia(${response.data.id})'>
                                <i class='fa fa-eye'></i>
                            </button>
                            <button type='button' class='btn btn-outline-purple' onclick='editSocialMedia(${response.data.id})'>
                                <i class='mdi mdi-pencil'></i>
                            </button>

                            <button type='button'  name='delete' class="btn btn-outline-danger"onclick="deleteSocialMedia(${response.data.id})">
                                <i class="mdi mdi-delete "></i>
                            </button></td>
                                `
                            );

                            if (response.data.message) {
                                $('#edit_modal').modal('hide');
                                toastMixin.fire({
                                    icon: 'success',
                                    animation: true,
                                    title: "" + response.data.message + ""
                                });
                                $('.SocialMediaUpdateForm')[0].reset();
                            }
                        } else {

                            toastMixin.fire({
                                icon: 'error',
                                animation: true,
                                title: "" + response.data.error + ""
                            });

                        }

                    }, //success end
                });
            });

        }



        // delete slider
        function deleteSocialMedia(id) {
            // alert(id)
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: config.routes.delete,
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            if (response.success === true) {
                                Swal.fire(
                                    'Deleted!',
                                    "" + response.data.message + "",
                                    'success'
                                )
                                // swal("Done!", response.data.message, "success");
                                $('#social_MediaTable').DataTable().row('.SocialMediaClass' + response.data.id)
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
