@extends('layouts.admin.master')
@section('title')
Dashboard
@endsection
@section('pageCss')
   
<style>
    .fas{
        font-size: 60px;
        color: purple;
        vertical-align: middle;
        align-content: center;
    }
    .icon_color{
        color: purple;
    }
    .set_height{
        min-height: 160px;
    }
</style>
@endsection
@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <h5>Orders</h5> 
            <hr>          
            <div class="row">   
                <div class="col-md-6 col-xl-3">
                    <div class="card text-center m-b-30">
                        <a href="javascript:void(0)">
                        <div class="row d-flex justify-content-center">
                            
                            {{-- <div class="col-md-4 ">
                                <div class="mb-2 card-body ">
                                <i class="fas fa-users "></i>
                                 </div>
                            </div> --}}
                            <div class="col-md-8">
                                <div class="mb-2 card-body text-muted">
                                <h3 class=" icon_color">{{ $latesOrder }}</h3>
                                 New order
                            </div>
                            </div>
                          
                        </div>
                          </a>
                        
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card text-center m-b-30">
                        <a href="javascript:void(0)">
                        <div class="row d-flex justify-content-center">
                            {{-- <div class="col-md-4 ">
                                <div class="mb-2 card-body ">
                                <i class="fas fa-user-shield"></i>
                                 </div>
                            </div> --}}
                            <div class="col-md-8">
                                <div class="mb-2 card-body text-muted">
                                <h3 class=" icon_color">{{ $orderpendingcount }}</h3>
                                Pending Order
                            </div>
                            </div>
                        </div>
                         </a>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card text-center m-b-30">
                        <a href="javascript:void(0)">
                        <div class="row d-flex justify-content-center">
                            {{-- <div class="col-md-4 ">
                                <div class="mb-2 card-body ">
                                <i class="fas fa-user-tie"></i>
                                 </div>
                            </div> --}}
                            <div class="col-md-8">
                                <div class="mb-2 card-body text-muted">
                                <h3 class=" icon_color">{{ $ordercompletecount }}</h3>
                                Complete order
                            </div>
                            </div>
                        </div>
                         </a>
                        
                    </div>
                </div>
            </div>
            <h5>Customar & Review</h5> 
            <hr>
            <div class="row">

                <div class="col-md-6 col-xl-3">
                    <div class="card text-center m-b-30">
                        <a href="javascript:()">
                        <div class="row d-flex justify-content-center">
                            {{-- <div class="col-md-4 ">
                                <div class="mb-2 card-body ">
                                <i class="fas fa-clipboard-list"></i>
                                 </div>
                            </div> --}}
                            <div class="col-md-8">
                                <div class="mb-2 card-body text-muted">
                                <h3 class=" icon_color">{{ $totalCustomer }}</h3>
                                Total Customar
                            </div>
                            </div>
                        </div>
                         </a>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card text-center m-b-30">
                        <a href="javascript:void(0)">
                        <div class="row d-flex justify-content-center">
                            {{-- <div class="col-md-4 ">
                                <div class="mb-2 card-body ">
                                <i class="fas fa-clipboard-list"></i>
                                 </div>
                            </div> --}}
                            <div class="col-md-8">
                                <div class="mb-2 card-body text-muted">
                                {{-- <h3 class=" icon_color">{{ $latestbookreview->review }}</h3> --}}
                                <h6 class=" icon_color" style="font-size: 12px;text-align: center;">{{ $latestbookreview->review }}</h6>
                                Latest Review
                            </div>
                            </div>
                        </div>
                         </a>
                    </div>
                </div>
               
                
            </div>
             
            <h5>Top Selling Book & Category</h5> 
            <hr>
            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="card text-center m-b-30">
                         <a href="javascript:void(0)">
                        <div class="row d-flex justify-content-center">
                            {{-- <div class="col-md-4 ">
                                <div class="mb-2 card-body ">
                                <i class="fas fa-file-invoice-dollar"></i>
                                 </div>
                            </div> --}}
                            <div class="col-md-8">
                                <div class="mb-2 card-body text-muted">
                                <h3 class=" icon_color" style="font-size: 19px">{{ $topsellingbook->title }}<span style="font-size: 18px;color: #707070;">({{ $topsellingbook->counted_order }})</span></h3>
                                Top Selling Book
                            </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card text-center m-b-30">
                         <a href="javascript:void(0)">
                        <div class="row d-flex justify-content-center">
                            {{-- <div class="col-md-4 ">
                                <div class="mb-2 card-body ">
                                <i class="fas fa-file-invoice-dollar"></i>
                                 </div>
                            </div> --}}
                            <div class="col-md-10">
                                <div class="mb-2 card-body text-muted">
                                
                                <h3 class=" icon_color">{{ $catName }}</h3>
                                Top Category
                            </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
             
        </div><!-- container -->

    </div> <!-- Page content Wrapper -->

@endsection
