@extends('layouts.user')

@section('title')
    <title>KulinaFood - Detail Produk {{ $ite->productName }}</title>
@endsection

@section('content')
<!-- Start Shop Detail  -->
<div class="shop-detail-box-main">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-5 col-md-6">
                <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        @foreach ($ite->product_images as $key => $aa)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}"> <img class="d-block w-100" src="{{ asset('storage/images/gambar-produk/'. $aa->product_image_id) }}" alt="First slide"> </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev"> 
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                    <span class="sr-only">Previous</span> 
                </a>
                    <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next"> 
                    <i class="fa fa-angle-right" aria-hidden="true"></i> 
                    <span class="sr-only">Next</span> 
                </a>
                    <ol class="carousel-indicators mt-2">
                        @foreach ($ite->product_images as $key => $aa)
                            <li data-target="#carousel-example-1" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}">
                                <img class="d-block w-100 img-fluid" src="{{ asset('storage/images/gambar-produk/'. $aa->product_image_id) }}" alt="" />
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7 col-md-6">
                <div class="single-product-details">
                    <h2>{{ $ite->productName }}</h2>
                    <h5>{{ rupiah($ite->price) }}</h5>
                    <p class="available-stock">Terjual sebanyak  {{ $countProduct }}<p>
                    <h4>Short Description:</h4>
                    <p>{{ $ite->productDescription }} </p>
                    <ul>
                        <li>
                            <div class="form-group quantity-box">
                                <label class="control-label">Quantity</label>
                                <input class="form-control" value="1" min="1" max="20" type="number" id="quantity">
                            </div>
                        </li>
                    </ul>

                    <div class="price-box-bar">
                        <div class="cart-and-bay-btn">
                            <a class="btn hvr-hover" data-fancybox-close="" href="{{ route('buy-new', $ite->id) }}">Buy New</a>
                            <a class="btn hvr-hover" data-fancybox-close="" href="#" id="btn-add" data-name="{{ $ite->productName }}">Add to cart</a>
                        </div>
                    </div>

                    <div class="add-to-btn">
                        <div class="share-bar">
                            <a class="btn hvr-hover" href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                            <a class="btn hvr-hover" href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a>
                            <a class="btn hvr-hover" href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                            <a class="btn hvr-hover" href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a>
                            <a class="btn hvr-hover" href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row my-5">
            <div class="card card-outline-secondary my-4" style="width: 1200px;">
                <div class="card-header">
                    <h2>Product Reviews</h2>
                </div>
                <div class="card-body">
                    @forelse ($rating as $rate)
                        <div class="media mb-3">
                            <div class="mr-2"> 
                                <img class="rounded-circle border p-1" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2264%22%20height%3D%2264%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2064%2064%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_160c142c97c%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_160c142c97c%22%3E%3Crect%20width%3D%2264%22%20height%3D%2264%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2213.5546875%22%20y%3D%2236.5%22%3E64x64%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Generic placeholder image">
                            </div>
                            <div class="media-body">
                                <p><span> 
                                @if ($rate->rating == 1)
                                    <i class="fa fa-star" style="color: yellow"></i>
                                @elseif ($rate->rating == 2)
                                    <i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i>
                                @elseif ($rate->rating == 3)
                                    <i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i>
                                @elseif ($rate->rating == 4)
                                    <i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i>
                                @elseif ($rate->rating == 5)
                                    <i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i>
                                @endif</span>{{ $rate->ratingDescription }}</p>
                                <small class="text-muted">Posted by {{ $rate->user->nama_lengkap }} on {{ \Carbon\Carbon::parse($rate->created_at)->format('d M Y') }}</small>
                            </div>
                        </div>
                        <hr>
                    @empty
                        <div class="media mb-3">
                            <h1>Belum ada review</h1>
                        </div>
                        <hr>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>Featured Products</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
                </div>
                <div class="featured-products-box owl-carousel owl-theme">
                    @foreach ($product as $item)
                        <div class="item">
                            <div class="products-single fix">
                        <div class="box-img-hover">
                            <div class="type-lb">
                                <p class="sale">
                                @if ($item->best_seller == 1)
                                    BEST SELLER
                                @elseif ($item->new == 1)
                                    NEW
                                @else
                                    SALE
                                @endif </p>
                            </div>
                            @foreach ($item->product_images as $re => $ii)
                                @if($item->product_images->first() == $ii)
                                    <img src="{{ asset('storage/images/gambar-produk/'. $ii->product_image_id) }}" class="img-fluid" alt="Image" loading="lazy">
                                @endif
                            @endforeach
                            <div class="mask-icon">
                                <ul>
                                    <li><a href="{{ route('detail-product', $item->id) }}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                </ul>
                                <a class="cart" href="#" id="btn-add2" data-id="{{ $item->id }}" data-name="{{ $item->productName }}">Add to Cart</a>
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
        </div>
    </div>
</div>
<!-- End Cart -->

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
            $(document).on('click', '#btn-add2', function (e) {
                var id = $(this).data("id2");
                var countt = $('#count-cart').val();
                var name = $(this).data("name");
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
            $(document).on('click', '#btn-add', function (e) {
                var id = $(this).data("id");
                var countt = $('#count-cart').val();
                var name = $(this).data("name");  
                var quantity = $('#quantity').val();      
                e.preventDefault();
                $.ajax({
                    url: `{{ route('add-cart-2', $ite->id) }}`,
                    type: 'get',
                    data: {
                        'id' : id,
                        'quantity' : quantity
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response != null) {
                            var number = parseInt(countt) + response.value;
                            document.getElementById('count').innerHTML = number;
                            document.getElementById('count-cart').value = number;
                            document.getElementById('nameProduct').innerHTML = response.name;
                            swal("Sukses", "Berhasil Menambah Produk " +name+ " Sebanyak "+quantity+" Porsi Ke Keranjang", "success");
                        }
                    }
                });
            });
        </script>
    @else
        <script>
            $(document).on('click', '#btn-add2', function (e) {
                swal("Info", "Silahkan Login Terlebih Dahulu", "info");
            });
            $(document).on('click', '#btn-add', function (e) {
                swal("Info", "Silahkan Login Terlebih Dahulu", "info");
            });
        </script>
    @endif
@endpush