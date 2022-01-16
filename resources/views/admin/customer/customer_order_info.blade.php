@extends('layouts.admin.master')
@section('title')
    User Orders
@endsection
@section('pageCss')
<style>
    #viewModal span{
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
                                <h4 class="mt-0 header-title">All Orders of : {{ $user_name }}</h4>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="order_info_table" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Order Status</th>
                                        <th>Total</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($user_orders))
                                        @foreach ($user_orders as $user_order)
                                            <tr class="publication{{ $user_order->order_id }}">
                                                <td>{{ $user_order->id }}</td>
                                                <td>
                                                    @if($user_order->order_status_id==1)
                                                    <small class='badge badge-warning'> {{ $user_order->order_status->name }}</small>
                                                    @elseif($user_order->order_status_id==2)
                                                    <small class='badge badge-info'> {{ $user_order->order_status->name }}</small>
                                                    @elseif($user_order->order_status_id==3) 
                                                    <small class='badge badge-success'> {{ $user_order->order_status->name }}</small>
                                                    @else
                                                    <small class='badge badge-danger'> {{ $user_order->order_status->name }}</small> 
                                                    @endif
                                                </td>
                                                <td>{{ $user_order->total }}</td>
                                                <td>{{ $user_order->name }}</td>
                                                

                                                <td class="actionBtn text-center">
                                                    <button type='button' class='btn btn-outline-purple'
                                                        onclick='viewOrderInfo({{$user_order->order_id }})'><i class='fa fa-eye'></i></button>
                                                        {{-- <button type='button' name='delete' class="btn btn-outline-danger "
                                                        onclick="deleteOrderInfo({{$user_order->order_id }})"><i
                                                            class="mdi mdi-delete "></i></button> --}}
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
<!-- view  Modal -->
<div class="modal fade bs-example-modal-center" id="viewModal" tabindex="-1" role="dialog"
aria-labelledby="mySmallModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
        <div class="modal-header d-block">
            <h5 class="modal-title mt-0 text-center">Order Details</h5>
            <button type="button" class="close modal_close_icon" data-dismiss="modal" aria-hidden="true">×</button>
            
        </div>
        <div class="modal-body">
            <div class="col-xl-12 col-md-12">
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <h6>Order ID: #<span id="view_order_id"></span></h6>
                            <h6>Customer Name: <span id="view_customer_name"></span></h6>
                            <h6>Customer Email: <span id="view_customer_email"></span></h6>
                            <h6>Customer Contact: <span id="view_customer_contact"></span></h6>
                            <h6>Customer Address: <span id="view_customer_address"></span></h6>
                            <h6>Payment Method: <span id="view_payment_method"></span></h6>
                            <h6>Order Status: <span id="view_payment_status"></span></h6>
                            <h6>Note: <span id="view_note"></span></h6>
                        </div>
                        <div class="col-6">
                            
                        </div>
                    </div>

                </div>
                
                <div class="col-12 mt-3">
                    <h5>Ordered Books</h5>
                </div>
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center orderTable">
                            <thead>
                                <tr>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total Price</th>
                                </tr>
                            </thead>
                            <tbody class="apeend_tbody">
                                <tr>
                                    <td class="item_name"></td>
                                    <td class="item_price">TK </td>
                                    <td class="item_quantity"></td>
                                    <td class="item_total_price">TK </td>
                                </tr>
                            </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3">Sub Total</td>
                                        <td>Tk <span class="subTotal"></span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Delivery Fee</td>
                                        <td>Tk <span class="deleveryFee"></span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Total Amount</td>
                                        <td>Tk <span class="view_total"></span> </td>
                                    </tr>
                                </tfoot>
                        </table>
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


@endsection

@section('pageScripts')
<script>
    $(document).ready(function() {
        $('#order_info_table').DataTable({
            "ordering": false,
        });

        $('.customer_management').addClass('active')
    });

        function viewOrderInfo (id) {
            $.ajax({
                url: "{!! route('order.view') !!}",
                method: "POST",
                data: {
                    id:id,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                
                        $('.payment_id').html(response.data.payment_id??'N/A')
                        $('#view_order_id').html(response.data.id)

                        $('#view_payment_method').html((response.data.payment_id==null)?`N/A`:response.data.payment_method.payment_method)
                        $('#view_payment_status').html(response.data.order_status.name)

                        $('#view_customer_name').html(response.data.name??'N/A')
                        $('#view_customer_email').html(response.data.user.email??'N/A')
                        $('#view_customer_contact').html(response.data.phone??'N/A')
                        $('#view_customer_address').html(response.data.address??'N/A')
                        $('#view_note').html( response.data.notes == null ? 'N/A' : response.data.notes != '' ? response.data.notes : 'N/A')
                        
                        $(".apeend_tbody").empty();
                        $.each(response.data.books, function(key, val) {
                            $('.apeend_tbody').append(`
                            <tr>
                                <td class="item_name">${val.title}</td>
                                <td class="item_price">TK ${val.discounted_price}</td>
                                <td class="item_quantity"> ${val.pivot.quantity}</td>
                                <td class="item_total_price">TK ${val.pivot.amount}</td>
                            </tr>
                             `)
                        });

                        $('.subTotal').html(response.data.subtotal)
                        $('.deleveryFee').html(response.data.delivery_fee)
                        $('.view_total').text(response.data.total)
                      
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

        // delete deleteOrderInfo
        function deleteOrderInfo(id) {
            //alert(id)
            Swal.fire({
                title: 'Are you sure?',
                text: "Order information will be deleted",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "Post",
                        url: "{!! route('order.delete') !!}",
                        data: {
                            id:id,
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            if (response.success === true) {
                                toastr['success'](response.data.message);

                                $('#order_info_table').DataTable().row('.publication' + id)
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

</script>
@endsection