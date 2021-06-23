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
                                <h5 class="card-title">Physical Store Sell Log</h5>
                            </div>
                            <div class="card-content" >
                                <div class="card-body">
                                    <b>Sold Item Log</b>
                                    @foreach($soldSell as $sell)
                                    <p>Product Name: {{$sell->product_name}} Total Price: {{$sell->total_price}} Customer Name: {{$sell->customer_name}} DateTime: {{$sell->created_at}}</p>
                                    @endforeach 

                                    <br><br>
                                    <b>Pending Item Log</b>
                                        @foreach($pendingSell as $psell)
                                        <p>Product Name: {{$psell->product_name}} Total Price: {{$psell->total_price}} Customer Name: {{$psell->customer_name}} DateTime: {{$psell->created_at}}</p>
                                        @endforeach 
                                </div>
                            </div>

                            <a href="/system/sales/physical_store">Back</a>

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