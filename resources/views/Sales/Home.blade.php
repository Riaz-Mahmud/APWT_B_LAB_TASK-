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
                            </div>
                            <div class="card-content" >
                                <div class="card-body">
                                    <a href="/system/sales/physical_store">Physical Store</a> 
                                    <b>|</b> 
                                    <a href="/system/sales/social_media">Social Media </a> 
                                    <b>|</b>
                                    <a href="/system/sales/ecommerce">Ecommerce Web App </a>
                                    <br><br>
                                    <h4>Todays Sale:</h4>
                                    <h6>Physical Store: {{$todayPhysicalSale}}</h6>
                                    <h6>Social Media: {{$todaySocialSale}}</h6>
                                    <h6>Ecommerce Web App: {{$todayEcomSale}} </h6>
                                    <br>
                                    <h4>Last 7 Days Sale: </h4>
                                    <h6>Physical Store: {{$thisWeekPhysicalSale}}</h6>
                                    <h6>Social Media: {{$thisWeekSocialSale}}</h6>
                                    <h6>Ecommerce Web App: {{$thisWeekEcomSale}}</h6>
                                    <br>
                                    
                                    <br><br>
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