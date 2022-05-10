@extends('layouts.admin.master')
@section('pageCss')
    <style>
        .employee_signature {
            height: 60px;
            border-radius: 50%;
        }

        .view_employee_signature {
            max-height: 220px;
            max-width: 467px;
        }
        .view_signature {
            /* max-height: 220px; */
            max-width: 467px;
        }
        .filter_by_role{
            width: 145px;
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
                                    <h4 class="mt-0 header-title">All Admins</h4>
                                </div>
                                
                                    <button type="button"
                                        class="btn btn-outline-purple float-right waves-effect waves-light" name="button"
                                        id="addButton" data-toggle="modal" data-target="#add"> Add
                                        New
                                    </button>
                               

                            </div>

                            <span class="showError"></span>
                            <table id="employeeTable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($employees))
                                        @foreach ($employees as $employee)
                                            <tr class="employee{{ $employee->id }}">
                                               
                                                <td>{{ $employee->name }}</td>
                                                <td>{{ $employee->email }}</td>
                                                <td>{{ $employee->phone }}</td>
                                                
                                                <td>
                                                    <button type='button' class='btn btn-outline-dark'
                                                        onclick='viewEmployee({{ $employee->id }})'><i
                                                            class='fa fa-eye'></i></button>
                                                    
                                                        <button type='button' class='btn btn-outline-primary '
                                                            onclick='editEmployee({{ $employee->id }})'><i
                                                                class='mdi mdi-pencil'></i></button>
                                                        <button type='button' name='delete' class="btn btn-outline-danger"
                                                            onclick="deleteEmployee({{ $employee->id }})"><i
                                                                class="mdi mdi-delete "></i></button>


                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                                {{-- <tfoot>
                                    <tr>
                                        <th></th>
                                    </tr>
                                </tfoot> --}}
                            </table>

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
                    <h5 class="modal-title mt-0 text-center">Add New Admin</h5>
                    <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form class="employeeAddForm" method="POST"> @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Type name" />
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone" placeholder="Type phone no" />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Type email" />
                        </div>
                        <div class="form-group">
                            <label>Select Role</label>
                            <select name="role" class="form-control" id="role">
                                <option value="">Select Role</option>
                                    <option value="1">Admin</option>
                                    <option value="0">User</option>
                            </select>
                        </div>
                        

                        <div class="form-group ">
                            <label>Image</label>
                            <div class="custom-file">
                                <input type="file" name="profile_image" class="custom-file-input dropify"
                                    data-errors-position="outside" data-allowed-file-extensions='["jpg", "png"]'
                                    data-max-file-size="0.6M">
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
                    <h5 class="modal-title mt-0 text-center">Update Admin's Info</h5>
                    <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form class="updateemployeeForm" method="POST"> @csrf
                        <input type="hidden" name="hidden_id" id="hidden_id">

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name"
                                placeholder="Type name" />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" id="edit_email"
                                placeholder="Type email" />
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone" id="edit_phone"
                                placeholder="Type phone no" />
                        </div>
                        <div class="form-group">
                            <label>Select Role</label>
                            <select name="role" class="form-control" id="role">
                                <option value="">Select Role</option>
                                    <option value="1">Admin</option>
                                    <option value="0">User</option>
                            </select>
                        </div>
                       
                        <div class="form-group ">
                            <label>Image</label>
                            <div class="custom-file edit_profile_image">
                                <input type="file" name="profile_image" id="edit_profile_image" class="custom-file-input dropify"
                                    data-max-file-size="0.6M" data-errors-position="outside">
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
                    <h5 class="modal-title mt-0 text-center">Admin's Details</h5>
                    <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-md-12 text-center signature_row mb-3">
                        <div class="ms-form-group">
                            {{-- <label for="name"><strong>Logo:</strong></label> --}}
                            <img src="" id="view_image" class="view_employee_signature">
                        </div>
                    </div>

                    <div class="col-xl-12 col-md-12">
                        <div class="ms-form-group">
                            <label for="name"><strong>Name:</strong></label>
                            <p id="view_name"></p>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-12">
                        <div class="ms-form-group">
                            <label for="name"><strong>Email:</strong></label>
                            <p id="view_email"></p>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-12">
                        <div class="ms-form-group">
                            <label for="name"><strong>Phone:</strong></label>
                            <p id="view_phone"></p>
                        </div>
                    </div>
                   



                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- view  Modal End -->
@endsection
@section('pageScripts')

    <script type='text/javascript'>

        var config = {
            routes: {
                add: "{!! route('admin.store') !!}",
                edit: "{!! route('admin.edit') !!}",
                view: "{!! route('admin.show') !!}",
                update: "{!! route('admin.update') !!}",
                delete: "{!! route('admin.delete') !!}",
            }
        };

        $('#addButton').on('click', function() {
            $('.dropify-preview').hide();
            $('.employeeAddForm').trigger('reset');
        });


        $(document).ready(function() {
            // data table
            $('#employeeTable').DataTable({
                "ordering": false,
            });
            // dropify table
            $('.dropify').dropify();
            $('.signature_input_box').hide();
        });
        // $(document).ready(function() {
        //     $('#employeeTable').DataTable({
        //         "ordering": false,
        //         initComplete: function() {
        //             this.api().columns().every(function() {
        //                 var column = this;
        //                 var select = $(
        //                         '<select class="form-control filter_by_role"><option value="">Search by Role</option></select>'
        //                         )
        //                     .appendTo($(column.footer()).empty())
        //                     .on('change', function() {
        //                         var val = $.fn.dataTable.util.escapeRegex(
        //                             $(this).val()
        //                         );

        //                         column
        //                             .search(val ? '^' + val + '$' : '', true, false)
        //                             .draw();
        //                     });

        //                 column.data().unique().sort().each(function(d, j) {
        //                     select.append('<option value="' + d + '">' + d +
        //                         '</option>')
        //                 });
        //             });
        //         }
        //     });

        //     $('#employeeTable tfoot tr').prependTo('#employeeTable thead');
        //     $('.loader').hide();

        // });

        // add form validation
        $(document).ready(function() {
            $(".employeeAddForm").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 50,
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 50,
                    },
                    phone: {
                        required: true,
                        digits: true,
                        maxlength: 50,
                    },
                    
                    
                    profile_image: {
                        required: true,
                    },
                    role: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: 'Please insert employee name',
                    },
                    email: {
                        required: 'Please insert employee email',
                    },
                    phone: {
                        required: 'Please insert employee phone number',
                    },
                    image: {
                        required: 'Please upload employee signature',
                    },
                    role: {
                        required: 'Please Select Role Admin/User',
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

        $(document).on('submit', '.employeeAddForm', function(event) {
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
                        var employeeTable = $('#employeeTable').DataTable();
                        var trDOM = employeeTable.row.add([
                            "" + response.data.name + "",
                            "" + response.data.email + "",
                            "" + response.data.phone + "",
                            `
                            <button type='button' class='btn btn-outline-dark' onclick='viewEmployee(${response.data.id})'>
                                <i class='fa fa-eye'></i>
                            </button>
                            <button type='button' class='btn btn-outline-primary' onclick='editEmployee(${response.data.id})'>
                                <i class='mdi mdi-pencil'></i>
                            </button>
                           
                            <button type='button'  name='delete' class="btn btn-outline-danger"onclick="deleteEmployee(${response.data.id})">
                                <i class="mdi mdi-delete "></i>
                            </button>
                            `
                        ]).draw().node();
                        $(trDOM).addClass('employee' + response.data.id + '');
                        $('.employeeAddForm').trigger('reset');
                        if (response.data.message) {
                            toastMixin.fire({
                                icon: 'success',
                                animation: true,
                                title: "" + response.data.message + ""
                            });
                            $('#add').modal('hide')
                        }


                    } else {
                        $('#add').modal('hide')
                        html = `<div class="alert alert-danger text-center" role="alert">
                                    <strong>${response.data.error}</strong>.
                                </div>
                            `;
                        $('.showError').fadeIn(100).html(html);
                        $('.showError').fadeOut(5000);
                    }
                }, //success end

                beforeSend: function() {
                    // $('#add').modal('hide');
                    $('.preloader').empty();
                    $('.preloader').addClass('ajax_loader').append(
                        `<div class='preloader'>
                            <div id="status">
                                <div class="spinner"></div>
                            </div>
                        </div>`
                    );
                },
                complete: function() {
                    $('.preloader').removeClass('ajax_loader').empty();
                }
            });
        });

        //request end


        // view single 
        function viewEmployee(id) {
            $.ajax({
                url: config.routes.view,
                method: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        $('#view_name').text(response.data.name);
                        $('#view_email').text(response.data.email);
                        $('#view_phone').text(response.data.phone);
                       

                        if (response.data.image === null) {
                            $('#view_image').removeAttr('src');
                        } else {
                            $('#view_image').attr('src', '/images/' + response.data.image);
                        }
                        


                        $('#viewModal').modal('show');

                    } //success end

                }
            }); //ajax end
        }




        // Update product
        //validation
        $(document).ready(function() {
            $(".updateemployeeForm").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 50,
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 50,
                    },
                    phone: {
                        required: true,
                        digits: true,
                        maxlength: 50,
                    },
                    role: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: 'Please insert employee name',
                    },
                    email: {
                        required: 'Please insert employee email',
                    },
                    phone: {
                        required: 'Please insert employee phone number',
                    },
                    role: {
                        required: 'Please Select Role Admin/User',
                    },
                },
                errorPlacement: function(label, element) {
                    label.addClass('mt-2 text-danger');
                    label.insertAfter(element);
                },
            });
        });


        function editEmployee(id) {
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
                        var path = "{{ url('/') }}" + '/images/';
                        $('#edit_name').val(response.data.name)
                        $('#edit_email').val(response.data.email)
                        $('#edit_phone').val(response.data.phone)
                        
                        $('#hidden_id').val(response.data.id)
                       


                        
                       
                        
                        if (response.data.image) {
                            var profile_img_url = path + response.data.image;

                            $("#edit_profile_image").attr("data-height", 150);
                            $("#edit_profile_image").attr("data-min-width", 450);
                            $("#edit_profile_image").attr("data-default-file", profile_img_url);
                            $('.edit_profile_image').find(".dropify-wrapper").removeClass("dropify-wrapper").addClass(
                                "dropify-wrapper has-preview");
                            $('.edit_profile_image').find(".dropify-preview").css('display', 'block');
                            $('.edit_profile_image').find('.dropify-render').html('').html('<img src=" ' + profile_img_url +
                                '">')
                        } else {
                            $(".dropify-preview .dropify-render img").attr("src", "");
                        }


                        $('#edit_modal').modal('show');

                    } //success end

                }
            });
            $(document).off('submit', '.updateemployeeForm');
            $(document).on('submit', '.updateemployeeForm', function(event) {
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
                            $('.employee' + response.data.id).html(
                                `
                                <td>${response.data.name}</td>
                                <td>${response.data.email}</td>
                                <td>${response.data.phone}</td>      
                                <td><button type='button' class='btn btn-outline-dark' onclick='viewEmployee(${response.data.id})'>
                                <i class='fa fa-eye'></i>
                            </button>
                            <button type='button' class='btn btn-outline-primary' onclick='editEmployee(${response.data.id})'>
                                <i class='mdi mdi-pencil'></i>
                            </button>
                           
                            <button type='button'  name='delete' class="btn btn-outline-danger"onclick="deleteEmployee(${response.data.id})">
                                <i class="mdi mdi-delete "></i>
                            </button></td>
                                `
                            );

                            if (response.data.message) {
                                toastMixin.fire({
                                    icon: 'success',
                                    animation: true,
                                    title: "" + response.data.message + ""
                                });
                                $('.updateemployeeForm')[0].reset();
                            }


                        } else {
                            html = `<div class="alert alert-danger text-center" role="alert">
                                    <strong>${response.data.error}</strong>.
                                </div>
                            `;
                            $('.showError').fadeIn(100).html(html);
                            $('.showError').fadeOut(5000);

                        }

                    }, //success end

                    beforeSend: function() {
                        $('#edit_modal').modal('hide');
                        $('.preloader').empty();
                        $('.preloader').addClass('ajax_loader').append(
                            `<div class='preloader'>
                            <div id="status">
                                <div class="spinner"></div>
                            </div>
                        </div>`
                        );
                    },
                    complete: function() {
                        $('.preloader').removeClass('ajax_loader').empty();
                    }
                });
            });

        }



        // delete slider
        function deleteEmployee(id) {
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
                                $('#employeeTable').DataTable().row('.employee' + response.data.id)
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
