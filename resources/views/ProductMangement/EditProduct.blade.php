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
                                <h5 class="card-title">Edit Product Details</h5>
                            </div>
                            
                            <div class="card-content" >
                                <div class="card-body">
                                <form action="/system/product_management/existing_products/edit" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <div class="row">
                                        <input type="text" name="id" value="{{ $pDetails->id }}" required hidden />
                                            <div class="col-12 col-sm-12 col-lg-12" style="margin-top:5px;">
                                                <input type="text" class="form-control" value="{{ $pDetails->product_name }}" name="product_name" placeholder="product_name" required>
                                            </div>
                                            <div class="col-12 col-sm-12 col-lg-12" style="margin-top:5px;">
                                                <fieldset class="form-group">
                                                    <select name="category" class="form-control" id="basicSelect" required>
                                                        <option disabled >Select category</option>
                                                        <option @if($pDetails->category=="Grocery") selected @endif value="Grocery">Grocery</option>
                                                        <option  @if($pDetails->category=="Medical") selected @endif value="Medical">Medical</option>
                                                        <option @if($pDetails->category=="Stationary") selected @endif value="Stationary">Stationary</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-sm-12 col-lg-12" style="margin-top:5px;">
                                                <input type="number" min=0 class="form-control"  value="{{ $pDetails->price }}" name="unit_price" placeholder="unit_price" required>
                                            </div>
                                             <div class="col-12 col-sm-12 col-lg-12" style="margin-top:5px;">
                                                <fieldset class="form-group">
                                                    <select name="status" class="form-control" id="basicSelect" required>
                                                        @if($pDetails->status == "existing")
                                                        <option disabled>Select Status</option>
                                                        <option selected value="existing">existing</option>
                                                        <option value="upcoming">upcoming</option>
                                                        @else
                                                        <option disabled>Select Status</option>
                                                        <option value="existing">existing</option>
                                                        <option selected value="upcoming">upcoming</option>
                                                        @endif
                                                    </select>
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-12 col-sm-12" style="margin-top: 10px">
                                                <button type="submit" class="btn btn-block btn-success glow">Update</button>
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