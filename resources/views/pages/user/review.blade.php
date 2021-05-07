@extends('layouts.user')

@section('title')
    <title>KulinaFood - Review Produk</title>
@endsection

@section('content')
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @foreach ($item->product as $items)                        
                    <h2>Review Produk {{ $items->productName }}</h2>
                @endforeach
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active">Cart</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Cart  -->
<div class="cart-box-main">
    <div class="container">
        <form action="{{ route('post-review', $item->id) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    @foreach ($item->product as $items)                        
                        <input type="hidden" name="ided" value="{{ $items->id }}">
                    @endforeach
                    <div class="form-group">
                        <label for="">Bintang</label><br>
                        <input type="radio" name="star" value="1"> <i class="fa fa-star" style="color: yellow"></i><br>
                        <input type="radio" name="star" value="2"> <i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i><br>
                        <input type="radio" name="star" value="3"> <i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i><br>
                        <input type="radio" name="star" value="4"> <i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i><br>
                        <input type="radio" name="star" value="5"> <i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i><br>
                    </div>
                    <div class="form-group">
                        <label for="">Review</label>
                        <textarea name="review" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <button class="ml-auto btn hvr-hover" style="color: #fff;" type="submit">
                        Leave Review
                    </button>
                </div>
            </div>
            
        </form>
    </div>
</div>
<!-- End Cart -->
@endsection

@push('addon-script')

@endpush