@extends('layouts.admin.master')
@section('title', 'Contact')
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
                                    <h4 class="mt-0 header-title">Contact</h4>
                                </div>
                               
                                    <button type="button"
                                        class="btn btn-outline-purple float-right waves-effect waves-light" name="button"
                                        id="addButton" data-toggle="modal" data-target="#ContactAddModal"> Add
                                        New
                                    </button>
                               
                            </div>
                            <span class="showError"></span>
                            <div class="table-responsive">
                            <table id="contact_Table" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Contact Number</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>PABX</th>
                                        <th>bCash</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($contacts))
                                        @foreach ($contacts as $contact)
                                            <tr class="ContactClass{{ $contact->id }}">
                                                <td>{{ $contact->name }}</td>
                                                <td>{{ $contact->contact_number }}</td>
                                                <td>{{ $contact->email }}</td>
                                                <td>{{ $contact->address }}</td>
                                                <td>{{ $contact->pabx ?? 'N/A' }}</td>
                                                <td>{{ $contact->bcash?? 'N/A' }}</td>
                                                <td class="actionBtn text-center">
                                                    <button type='button' class='btn btn-outline-purple'
                                                        onclick='viewContact({{ $contact->id }})'><i
                                                            class='fa fa-eye'></i></button>
                                                    <button type='button' class='btn btn-outline-purple '
                                                        onclick='editContact({{ $contact->id }})'><i
                                                            class='mdi mdi-pencil'></i></button>
                                                    <button type='button' name='delete' class="btn btn-outline-danger "
                                                        onclick="deleteContact({{ $contact->id }})"><i
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
    <div class="modal fade bs-example-modal-center" id="ContactAddModal" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h5 class="modal-title mt-0 text-center">Add Contact</h5>
                    <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form class="contactAddForm" method="POST"> @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="add_name" placeholder="Type name" />
                        </div>
                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" class="form-control" name="add_contact" placeholder="Type contact" />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="add_email" placeholder="Type email" />
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="add_address" class="form-control" cols="30" rows="5"></textarea>
                            {{-- <input type="text" class="form-control" name="add_address" placeholder="Type address" /> --}}
                        </div>
                       
                        <div class="form-group">
                            <label>PABX</label>
                            <input type="text" class="form-control" name="add_pabx" placeholder="Type pabx" />
                        </div>
                        <div class="form-group">
                            <label>bCash</label>
                            <input type="text" class="form-control" id="add_bcash" name="add_bcash"
                                placeholder="Type bCash" />
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
                    <h5 class="modal-title mt-0 text-center">Update Contact</h5>
                    <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form class="ContactUpdateForm" method="POST"> @csrf
                        <input type="hidden" id="hidden_id" name="hidden_id" value="">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" id="edit_name" name="edit_name" placeholder="Type name" />
                        </div>
                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" class="form-control" id="edit_contact" name="edit_contact"
                                placeholder="Type contact" />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" id="edit_email" name="edit_email"
                                placeholder="Type email" />
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="edit_address" id="edit_address" class="form-control" cols="30" rows="5"></textarea>
                            {{-- <input type="text" class="form-control" id="edit_address" name="edit_address"
                                placeholder="Type address" /> --}}
                        </div>
                        <div class="form-group">
                            <label>PABX</label>
                            <input type="text" class="form-control" id="edit_pabx" name="edit_pabx"
                                placeholder="Type fax" />
                        </div>
                        <div class="form-group">
                            <label>bCash</label>
                            <input type="text" class="form-control" id="edit_bcash" name="edit_bcash"
                                placeholder="Type bCash" />
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
                    <h5 class="modal-title mt-0 text-center">Contact Details</h5>
                    <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-md-12">
                        <div class="ms-form-group">
                            <label for="name"><strong>Name</strong></label>
                            <p id="view_name"></p>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-12">
                        <div class="ms-form-group">
                            <label for="contact"><strong>Contact Number</strong></label>
                            <p id="view_contact"></p>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-12">
                        <div class="ms-form-group">
                            <label for="email"><strong>Email</strong></label>
                            <p id="view_email"></p>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-12">
                        <div class="ms-form-group">
                            <label for="address"><strong>Address</strong></label>
                            <p id="view_address"></p>
                        </div>
                    </div>
                  
                    <div class="col-xl-12 col-md-12">
                        <div class="ms-form-group">
                            <label for="pabx"><strong>PABX</strong></label>
                            <p id="view_pabx"></p>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-12">
                        <div class="ms-form-group">
                            <label for="bcash"><strong>bCash</strong></label>
                            <p id="view_bcash"></p>
                        </div>
                    </div>
                  
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
                add: "{!! route('contacts.store') !!}",
                edit: "{!! route('contacts.edit') !!}",
                update: "{!! route('contacts.update') !!}",
                delete: "{!! route('contacts.delete') !!}",
            }
        };

        $('#addButton').on('click', function() {
            $('.dropify-preview').hide();
            $('.contactAddForm').trigger('reset');
        });

        var path = "{{ url('/') }}" + '/images';
        $(document).ready(function() {

            $('.dropify').dropify();
        });

        $(document).ready(function() {
            $('#contact_Table').DataTable({
                "ordering": false,
            });

            $('#contact_Table tfoot tr').prependTo('#contact_Table thead');
            $('.loader').hide();
            //$("#addButton").hide();

        });

        // add form validation
        $(document).ready(function() {
            $(".contactAddForm").validate({
                rules: {
                    add_name: {
                        required: true,
                        maxlength: 200,
                    },
                    add_address: {
                        required: true,
                        maxlength: 200,
                    },
                    add_contact: {
                        required: true,
                        maxlength: 11,
                        minlength: 11,
                        digits:true,
                       
                    },
                    add_email: {
                        required: true,
                        email: true,
                        maxlength: 100,
                    },
                    add_pabx: {
                        maxlength: 11,
                        digits:true,
                    },
                    add_bcash: {
                        maxlength: 11,
                        minlength: 11,
                        digits:true,
                    },

                },
                messages: {
                    add_name: {
                        required: 'Please insert name',
                    },
                    add_address: {
                        required: 'Please insert address',
                    },
                    add_contact: {
                        required: 'Please insert contact',
                    },
                    add_email: {
                        required: 'Please insert email',
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

        $(document).on('submit', '.contactAddForm', function(event) {
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


                        var contact_Table = $('#contact_Table').DataTable();

                        var row = $('<tr>')
                            .append(`<td>` + response.data.name + `</td>`)
                            .append(`<td>` + response.data.contact + `</td>`)
                            .append(`<td>` + response.data.email + `</td>`)
                            .append(`<td>` + response.data.address + `</td>`)
                            .append(response.data.pabx==null ?`<td>N/A</td>`: `<td>${response.data.pabx}</td>`)
                            .append(response.data.bcash==null ?`<td>N/A</td>`: `<td>${response.data.bcash}</td>`)
            
                           
                            .append(`<td><button type='button' class='btn btn-outline-purple' onclick='viewContact(${response.data.id})'>
                                <i class='fa fa-eye'></i>
                            </button>
                            <button type='button' class='btn btn-outline-purple' onclick='editContact(${response.data.id})'>
                                <i class='mdi mdi-pencil'></i>
                            </button>
                            <button type='button'  name='delete' class="btn btn-outline-danger"onclick="deleteContact(${response.data.id})">
                                <i class="mdi mdi-delete "></i>
                            </button></td>`)
                            


                        var user_row = contact_Table.row.add(row).draw().node();
                        $("#contact_Table tbody").empty();
                        $('#contact_Table tbody').prepend(row);
                        $(user_row).addClass('ContactClass' + response.data.id + '');

                        $('.contactAddForm').trigger('reset');
                        if (response.data.message) {
                            $('#ContactAddModal').modal('hide');
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

    
        //var path = "{{ url('/') }}" + '/images/';
        // view single
        function viewContact(id) {
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
                        $('#view_name').text(response.data.name);
                        $('#view_contact').text(response.data.contact_number);
                        $('#view_email').text(response.data.email);
                        $('#view_address').text(response.data.address);
                        //$('#view_pabx').text(response.data.pabx);
                        //$('#view_bcash').text(response.data.bcash);
                        if (response.data.pabx == null)
                            $('#view_pabx').text("N/A");
                        else
                            $('#view_pabx').text(response.data.pabx);

                        if (response.data.bcash == null)
                            $('#view_bcash').text("N/A");
                        else
                            $('#view_bcash').text(response.data.bcash);



                        $('#viewModal').modal('show');

                    } //success end

                }
            }); //ajax end
        }

        // Update product
        //validation
        $(document).ready(function() {
            $(".ContactUpdateForm").validate({
                rules: {
                    edit_name: {
                        required: true,
                        maxlength: 100,
                    },
                    edit_address: {
                        required: true,
                        maxlength: 100,
                    },
                    edit_contact: {
                        required: true,
                        maxlength: 11,
                        minlength: 11,
                        digits:true,
                    },
                    edit_email: {
                        required: true,
                        email: true,
                        maxlength: 2000,
                    },
                    edit_pabx: {
                        maxlength: 11,
                        digits:true,
                    },
                    edit_bcash: {
                        maxlength: 11,
                        minlength: 11,
                        digits:true,
                    },
                },
                messages: {
                    edit_name: {
                        required: 'Please insert name',
                    },
                    edit_address: {
                        required: 'Please insert address',
                    },
                    edit_contact: {
                        required: 'Please insert contact',
                    },
                    edit_email: {
                        required: 'Please insert email',
                    },
                },
                errorPlacement: function(label, element) {
                    label.addClass('mt-2 text-danger');
                    label.insertAfter(element);
                },
            });
        });


        function editContact(id) {
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
                        $('#edit_email').val(response.data.email)
                        $('#edit_address').val(response.data.address)
                        $('#edit_contact').val(response.data.contact_number)
                        $('#edit_pabx').val(response.data.pabx)
                        $('#edit_bcash').val(response.data.bcash)
                        
                        $('#hidden_id').val(response.data.id)

                        $('#edit_modal').modal('show');

                    } //success end

                }
            });
            $(document).off('submit', '.ContactUpdateForm');
            $(document).on('submit', '.ContactUpdateForm', function(event) {
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
                            $('.ContactClass' + response.data.id).html(
                                `
                                <td>${response.data.name}</td>
                                <td>${response.data.contact}</td>
                                <td>${response.data.email}</td>
                                <td>${response.data.address}</td>
                                <td>${response.data.pabx ?? 'N/A'}</td>
								<td>${response.data.bcash ?? 'N/A'}</td>
                                <td><button type='button' class='btn btn-outline-purple' onclick='viewContact(${response.data.id})'>
                                <i class='fa fa-eye'></i>
                            </button>
                            <button type='button' class='btn btn-outline-purple' onclick='editContact(${response.data.id})'>
                                <i class='mdi mdi-pencil'></i>
                            </button>
                            <button type='button'  name='delete' class="btn btn-outline-danger"onclick="deleteContact(${response.data.id})">
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
                                $('.ContactUpdateForm')[0].reset();
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
        function deleteContact(id) {
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
                                $('#contact_Table').DataTable().row('.ContactClass' + response.data.id)
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
