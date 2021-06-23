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
                        <div class="card col-12 col-sm-12 col-lg-8">
                            <div class="card-header">
                                <h4 class="card-title">Sell Product</h4>
                            </div>
                            <div class="card-content" >
                                <div class="card-body">
                                    <form action="#" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-lg-12" style="margin-top:5px;">
                                                <input type="text" class="form-control" name="name" placeholder="Customer Name" required>
                                            </div>
                                            <div class="col-12 col-sm-12 col-lg-12" style="margin-top:5px;">
                                                <input type="text" class="form-control" name="address" placeholder="Address" required>
                                            </div>
                                            <div class="col-12 col-sm-12 col-lg-12" style="margin-top:5px;">
                                                <input type="number" class="form-control" name="phone" placeholder="Phone" required>
                                            </div>

                                            <div class="col-12 col-sm-12 col-lg-12" style="margin-top:5px;">
                                                <fieldset class="form-group">
                                                    <select id="product" name="product" class="form-control product_list" id="basicSelect" required>
                                                        <option disabled selected>Select Product</option>
                                                        @foreach($productAll as $product)
                                                        <option value="{{$product->id}}">{{$product->product_name}} - {{$product->price}}Tk</option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-sm-12 col-lg-12">
                                                <input type="number" class="form-control" min=1 id="unit_price" name="unit_price" placeholder="Unit price" required>
                                            </div>
                                            <div class="col-12 col-sm-12 col-lg-12 quantity" style="margin-top:5px;">
                                                <input type="number" class="form-control" min=1 max=20 id="quantity" name="quantity" placeholder="Quantity" required>
                                            </div>
                                            <div class="col-12 col-sm-12 col-lg-12" style="margin-top:5px;">
                                                <input type="number" class="form-control" min=1 name="total_price" id="total_price" placeholder="Total Price" required>
                                            </div>
                                            <div class="col-12 col-sm-12 col-lg-12" style="margin-top:5px;">
                                                <fieldset class="form-group">
                                                    <select name="payment_type" class="form-control" id="basicSelect" required>
                                                        <option disabled selected>Payment Type</option>
                                                        <option value="cash">cash</option>
                                                        <option value="card">card</option>
                                                        <option value="onine">onine</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-sm-12" style="margin-top: 10px">
                                                <button type="submit" class="btn btn-block btn-success glow">SELL</button>
                                            </div>
                                        </div>
                                    </form>
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

    <script>
        $(document).ready(function(){
            $(document).on('change','.product_list',function(){
                var id = $("#product").val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('/system/sales/physical_store/checkProductDetails') }}",
                    type: "get",
                    data: {
                        id: id
                    },
                    success: function(result) {
                        console.log(result);

                        $('#unit_price').val(result.price);
                    }
                });
            });

            

            $(document).on('change','.quantity',function(){
                var quantity = $("#quantity").val();
                var unit_Price = $("#unit_price").val();
                console.log(quantity);
                console.log(unit_Price);

                $('#total_price').val(quantity*unit_Price);

            });

        });
    </script>

</body>
@endsection