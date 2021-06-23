@extends('Layout.app')

@section('body')

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">


    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- users list start -->
                <section class="users-list-wrapper">
                    <div class="users-list-filter">
                        @if(session()->has('error') && !session()->get('error'))
                        <div class="alert alert-success alert-dismissible mb-2" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <div class="d-flex align-items-center">
                                <i class="bx bx-like"></i>
                                <span>
                                    {{ session()->get('message') }}
                                </span>
                            </div>
                        </div>
                        @endif
                        @if(session()->has('error') && session()->get('error'))
                        <div class="alert alert-danger alert-dismissible mb-2" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <div class="d-flex align-items-center">
                                <i class="bx bx-error"></i>
                                <span>
                                    {{ session()->get('message') }}
                                </span>
                            </div>
                        </div>
                        @endif
                        <div class="card col-12 col-sm-12 col-lg-10">
                            <div class="card-header">
                                <h4 class="card-title">Welcome {{session('fullname')}}</h4>
                                <h5 class="card-title">Upcoming Product list</h5>
                            </div>
                            
                            <div class="card-content" >
                                <div class="card-body">
                                <div class="table-responsive">
                                    <b>Sold Item Log</b>
                                    <table border="1">
                                    <tr>
                                        <td> SL </td>
                                        <td> Name </td>
                                        <td> Price </td>
                                        <td> Action </td>
                                    </tr>
                                    
                                    @foreach($upcoming as $key=> $product)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$product->product_name}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>
                                            <a href="/system/product_management/product/{{$product->id}}/vendor_details/{{$product->vendorId}}"> Details </a> |
                                            <a href="/system/product_management/upcoming_products/edit/{{$product->id}}"> Edit </a> |
                                            <a href="/system/product_management/upcoming_products/delete/{{$product->id}}" onclick="return confirm('Are you sure?')"> Delete </a>
                                        </td>
                                    </tr>
                                     @endforeach 
                                     
                                    </table>
                                    <div class="col-md-12 col-12">
                                        {!! $upcoming->links() !!}
                                    </div>
                                    
                                    </div>
                                </div>
                            </div>

                            <a href="/system/product_management">Back</a>

                        </div>
                    </div>
                </section>
                <!-- users list ends -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @include('Layout.footer')

    @include('Layout.scripts')

</body>
@endsection