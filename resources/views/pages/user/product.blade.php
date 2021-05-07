@extends('layouts.user')

@section('title')
    <title>KulinaFood - Produk</title>
@endsection

@section('content')
    <!-- Start Shop Page  -->
    <div class="shop-box-inner">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                    <div class="right-product-box">
                        <div class="product-item-filter row">
                            <p>Showing all {{ $product->count() }} results</p>
                            <div class="col-12 col-sm-4 text-center text-sm-right">
                                <ul class="nav nav-tabs ml-auto">
                                    <li>
                                        <a class="nav-link active" href="#grid-view" data-toggle="tab"> <i class="fa fa-th"></i> </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#list-view" data-toggle="tab"> <i class="fa fa-list-ul"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="product-categorie-box">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                    <div class="row">
                                        @foreach ($product as $item)
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                <div class="products-single fix">
                                                    <div class="box-img-hover">
                                                        <div class="type-lb">
                                                            <p class="sale">@if ($item->best_seller == 1)
                                                                BEST SELLER
                                                            @elseif ($item->new == 1)
                                                                NEW
                                                            @else
                                                                SALE
                                                            @endif </p>
                                                        </div>
                                                        @foreach ($item->product_images as $re => $ii)
                                                            @if($item->product_images->first() == $ii)
                                                                <img src="{{ asset('storage/images/gambar-produk/'. $ii->product_image_id) }}" class="img-fluid" alt="Image">
                                                            @endif
                                                        @endforeach                                                        
                                                        <div class="mask-icon">
                                                            <ul>
                                                                <li><a href="{{ route('detail-product', $item->id) }}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                            </ul>
                                                            <a class="cart" href="#" id="btn-add" data-id="{{ $item->id }}" data-name="{{ $item->productName }}">Add to Cart</a>
                                                        </div>
                                                    </div>
                                                    <div class="why-text">
                                                        <p>{{ $item->categories->name }}</p>
                                                        <h4>{{ $item->productName }}</h4>
                                                        <p class="text-description">{{ $item->productDescription }}</p>
                                                        <h5>{{ rupiah($item->price) }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach                                        
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="list-view">
                                    @foreach ($product as $item)
                                        <div class="list-view-box">
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                    <div class="products-single fix">
                                                        <div class="box-img-hover">
                                                            <div class="type-lb">
                                                                <p class="new">@if ($item->best_seller == 1)
                                                                    BEST SELLER
                                                                @elseif ($item->new == 1)
                                                                    NEW
                                                                @else
                                                                    SALE
                                                                @endif </p>
                                                            </div>
                                                            @foreach ($item->product_images as $re => $ii)
                                                                @if($item->product_images->first() == $ii)
                                                                    <img src="{{ asset('storage/images/gambar-produk/'. $ii->product_image_id) }}" class="img-fluid" alt="Image">
                                                                @endif
                                                            @endforeach                                                            
                                                            <div class="mask-icon">
                                                                <ul>
                                                                    <li><a href="{{ route('detail-product', $item->id) }}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                                    <div class="why-text full-width">
                                                        <h4>{{ $item->productName }} <span style="font-size: 15px">( {{ $item->categories->name }} )</span></h4>
                                                        <h5>{{ rupiah($item->price) }}</h5>
                                                        <p>{{ $item->productDescription }}</p>
                                                        <a class="btn hvr-hover" href="#" id="btn-add" data-id="{{ $item->id }}" data-name="{{ $item->productName }}">Add to Cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! $product->links() !!}
                </div>
				<div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                    <div class="product-categori">
                        <div class="search-product">
                            <form action="{{ route('search-product') }}">
                                <input class="form-control" placeholder="Search product.." type="text" name="search">
                                <button type="submit"> <i class="fa fa-search"></i> </button>
                            </form>
                        </div>
                        <div class="filter-sidebar-left">
                            <div class="title-left">
                                <h3>Categories</h3>
                            </div>
                            <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">
                                <a href="{{ route('product') }}" class="list-group-item list-group-item-action">All</a>             
                                @foreach ($category as $cate)
                                    <a href="{{ route('product-category', $cate->id) }}" class="list-group-item list-group-item-action"> {{ $cate->name }}</a>             
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->

    <div class="d-flex justify-content-center">

    </div>

    <div class="modal" tabindex="-1" role="dialog" id="modalShow">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Berhasil</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Produk <span id="nameProduct"></span> sebanyak <span id="quantityValue"></span> porsi berhasil ditambah ke keranjang</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Lanjut Belanja</button>
            </div>
          </div>
        </div>
      </div>

    <input type="hidden" name="" class="form-control" id="count-cart" value="{{ $cart }}">
@endsection

@push('addon-script')
    @if (Auth::user())
        <script>
            $(document).on('click', '#btn-add', function (e) {
                var id = $(this).data("id");
                var name = $(this).data("name");
                var countt = $('#count-cart').val();
                e.preventDefault();
                $.ajax({
                    url: `{{ route('add-cart', $item->id) }}`,
                    type: 'get',
                    data: {
                        'id' : id
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response != null) {
                            var number = parseInt(countt) + response.value;
                            document.getElementById('count').innerHTML = number;
                            document.getElementById('count-cart').value = number;
                            swal("Sukses", "Berhasil Menambah Produk " +name+ " Ke Keranjang", "success");
                        }
                    }
                });
            });
        </script>
    @else
        <script>
            $(document).on('click', '#btn-add', function (e) {
                swal("Info", "Silahkan Login Terlebih Dahulu", "info");
            });
        </script>
    @endif
@endpush