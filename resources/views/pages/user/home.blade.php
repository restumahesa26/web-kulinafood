@extends('layouts.user')

@section('title')
    <title>KulinaFood</title>
@endsection

@section('content')
<!-- Start Slider -->
<div id="slides-shop" class="cover-slides">
    <ul class="slides-container">
        <li class="text-center">
            <img src="{{ url('frontend/images/banner-01.jpg') }}" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="m-b-20"><strong>Welcome To <br> KulinaFood</strong></h1>
                        <p class="m-b-40">Jelajahi seluruh kuliner yang tersedia di restoran kami <br> mulai dari olahan daging, ikan, hingga olahan sayuran sehat.</p>
                        <p><a class="btn hvr-hover" href="#">Shop New</a></p>
                    </div>
                </div>
            </div>
        </li>
        <li class="text-center">
            <img src="{{ url('frontend/images/banner-02.jpg') }}" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="m-b-20"><strong>Welcome To <br> Freshshop</strong></h1>
                        <p class="m-b-40">See how your users experience your website in realtime or view <br> trends to see any changes in performance over time.</p>
                        <p><a class="btn hvr-hover" href="#">Shop New</a></p>
                    </div>
                </div>
            </div>
        </li>
        <li class="text-center">
            <img src="{{ url('frontend/images/banner-03.jpg') }}" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="m-b-20"><strong>Welcome To <br> Freshshop</strong></h1>
                        <p class="m-b-40">See how your users experience your website in realtime or view <br> trends to see any changes in performance over time.</p>
                        <p><a class="btn hvr-hover" href="{{ route('product') }}">Shop New</a></p>
                    </div>
                </div>
            </div>
        </li>
    </ul>
    <div class="slides-navigation">
        <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
        <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
    </div>
</div>
<!-- End Slider -->

<!-- Start Categories  -->
<div class="categories-shop">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="shop-cat-box">
                    <img class="img-fluid" src="{{ url('frontend/images/categories_img_01.jpg') }}" alt="Olahan Sayuran"/>
                    <a class="btn hvr-hover" href="{{ route('product') }}">Olahan Sayuran</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="shop-cat-box">
                    <img class="img-fluid" src="{{ url('frontend/images/categories_img_02.jpg') }}" alt="" />
                    <a class="btn hvr-hover" href="{{ route('product') }}">Olahan Ikan</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="shop-cat-box">
                    <img class="img-fluid" src="{{ url('frontend/images/categories_img_03.jpg') }}" alt="" />
                    <a class="btn hvr-hover" href="{{ route('product') }}">Olahan Daging</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Categories -->

<!-- Start Products  -->
<div class="products-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>Makanan * Minuman</h1>
                    <p>Produk terbaik dan terlaris dari restoran kami</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="special-menu text-center">
                    <div class="button-group filter-button-group">
                        <button class="active" data-filter="*">All</button>
                        <button data-filter=".top-featured">New</button>
                        <button data-filter=".best-seller">Best seller</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row special-list">
            @foreach ($items as $key => $item)            
                <div class="col-lg-3 col-md-6 special-grid @if ($item->best_seller == 1)
                    best-seller
                @endif @if ($item->new == 1)
                    top-featured
                @endif "> 
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
</div>
<!-- End Products  -->

<!-- Start Instagram Feed  -->
<div class="instagram-box">
    <div class="main-instagram owl-carousel owl-theme">
        @foreach ($image as $imagee)
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('storage/images/gambar-instagram/'. $imagee->img_url) }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        @endforeach        
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