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
                <h2>Review Produk {{ $item->product->productName }}</h2>
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
        <form action="{{ route('update-review', $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="form-group">
                        <label for="">Bintang</label><br>
                        <input type="radio" name="star" value="1"@if ($item->rating == 1)
                            checked
                        @endif> <i class="fa fa-star" style="color: yellow"></i><br>
                        <input type="radio" name="star" value="2"@if ($item->rating == 2)
                            checked
                        @endif> <i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i><br>
                        <input type="radio" name="star" value="3"@if ($item->rating == 3)
                            checked
                        @endif> <i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i><br>
                        <input type="radio" name="star" value="4"@if ($item->rating == 4)
                            checked
                        @endif> <i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i><br>
                        <input type="radio" name="star" value="5"@if ($item->rating == 5)
                            checked
                        @endif> <i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i><i class="fa fa-star" style="color: yellow"></i><br>
                    </div>
                    <div class="form-group">
                        <label for="">Review</label>
                        <textarea name="review" id="" cols="30" rows="10" class="form-control">{{ $item->ratingDescription }}</textarea>
                    </div>
                    <button class="ml-auto btn hvr-hover" style="color: #fff;" type="submit">
                        Edit Review
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