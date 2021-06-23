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
                                <h5 class="card-title">Add Product</h5>
                            </div>
                            
                            <div class="card-content" >
                                <div class="card-body">
                                <form action="#" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-lg-12" style="margin-top:5px;">
                                                <input type="text" class="form-control" name="product_name" placeholder="product_name" required>
                                            </div>
                                            <div class="col-12 col-sm-12 col-lg-12" style="margin-top:5px;">
                                                <fieldset class="form-group">
                                                    <select name="category" class="form-control" id="basicSelect" required>
                                                        <option disabled selected>Select category</option>
                                                        <option value="Grocery">Grocery</option>
                                                        <option value="Medical">Medical</option>
                                                        <option value="Stationary">Stationary</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-sm-12 col-lg-12" style="margin-top:5px;">
                                                <input type="number" min=0 class="form-control" name="unit_price" placeholder="unit_price" required>
                                            </div>
                                             <div class="col-12 col-sm-12 col-lg-12" style="margin-top:5px;">
                                                <fieldset class="form-group">
                                                    <select name="status" class="form-control" id="basicSelect" required>
                                                        <option disabled selected>Select Status</option>
                                                        <option  value="existing">existing</option>
                                                        <option value="upcoming">upcoming</option>

                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-sm-12 col-lg-12" >
                                                <fieldset class="form-group">
                                                    <select name="vendor" class="form-control" id="basicSelect" required>
                                                        <option disabled selected>Select Vendor</option>
                                                        @foreach($vendor as $ven)
                                                        <option  value="{{$ven->id}}">{{$ven->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                            </div>
                                            </div>
                                            
                                            <div class="col-12 col-sm-12" style="margin-top: 10px">
                                                <button type="submit" class="btn btn-block btn-success glow">Add</button>
                                            </div>
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