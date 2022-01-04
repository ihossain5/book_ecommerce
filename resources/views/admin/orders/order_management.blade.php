@extends('layouts.admin.master')
@section('title')
    Publications
@endsection
@section('pageCss')

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
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($orders))
                                        @foreach ($orders as $order)
                                            <tr class="publication{{ $order->order_id }}">
     
                                                <td>{{ $order->name }}</td>
                                                <td>{{ $order->mobile }}</td>

                                                <td>
                                              <a href="{{route('order.invoice.download',[$order->order_id])}}">
                                                <button type='button' class='btn btn-outline-dark'
                                                ><i
                                                     class='fa fa-eye'></i>
                                                 </button>
                                              </a>

                                                    {{-- <button type='button' class='btn btn-outline-info '
                                                        onclick='editPublication({{ $publication->publication_id }})'><i
                                                            class='mdi mdi-pencil'></i></button>

                                                    <button type='button' name='delete' class="btn btn-outline-danger "
                                                        onclick="deletePublication({{ $publication->publication_id }})"><i
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
@endsection

@section('pageScripts')

@endsection