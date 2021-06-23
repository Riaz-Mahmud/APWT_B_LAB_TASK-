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
                                <h5 class="card-title">Existing Product Details</h5>
                            </div>
                            
                            <div class="card-content" >
                                <div class="card-body">
                                <div class="table-responsive">
                                    <b>Product Details</b>
                                <table border="1">
                                    <tr>
                                        <td> Name </td>
                                        <td> Price </td>
                                        <td> Status </td>
                                        <td> created at </td>

                                    </tr>
                                    <tr>
                                        <td>{{$pDetails->id}}</td>
                                        <td>{{$pDetails->product_name}}</td>
                                        <td>{{$pDetails->status}}</td>
                                        <td>{{$pDetails->created_at}}</td>

                                    </tr>
                                    <tr>
                                    <td>
                                        <input type="submit" name="Submit" onclick="return confirm('Are you sure?')" value="Delete">
                                    </td>
                                    
                                    </tr>
                                    
                                </table>

                                <a href="/system/product_management/existing_products">Back</a>
            
                                </div>
                            </div>
                            </div>

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