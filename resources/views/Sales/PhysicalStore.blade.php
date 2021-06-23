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
                                <h5 class="card-title">Physical Store</h5>
                            </div>
                            <div class="card-content" >
                                <div class="card-body">
                                    <h4>Todays Sale: {{$todayPhysicalSale}}</h4>                            
                                    <h4>Last 7 Days Sale: {{$thisWeekPhysicalSale}}</h4>
                                    <h4>Most sold item name:</h4>
                                    <h4>Average sales amount: {{$avg_sellAmount}}</h4>
                                    <br>
                                    <a href="/system/sales/physical_store/sell_product"> <h5>Sell products</h5></a>
                                    <a href="/system/sales/physical_store/sales_log"> <h5>View Sales Log</h5></a>
                                    <br>
                                    <a href="/system/sales">Back</a>
                                    <br>
                                    <a href="/logout"> Logout </a> 
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