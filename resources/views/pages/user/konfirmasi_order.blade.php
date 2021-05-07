@extends('layouts.user')

@section('title')
    <title>KulinaFood - Selesaikan Pembayaran</title>
@endsection

@section('content')
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Check Paying</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Order</a></li>
                    <li class="breadcrumb-item active">Check Paying</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Cart  -->
<div class="cart-box-main">
    <div class="container">
        <form action="{{ route('proses-konfirmasi-order', $id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="form-group">
                <label><h3>Metode Pembayaran<span>*</span></h3></label>
                <input type="text" class="form-control" value="{{ $pay->payingName }} a/n {{ $pay->name }}" readonly>
                <input type="hidden" class="form-control" value="{{ $pay->id }}" readonly name="method_paying_id">
            </div>
            <div class="form-group">
                <label for="bukti"><h3>Masukkan Bukti Pembayaran<span>*</span></h3></label>
                <input type="file" name="images_bukti" id="bukti" class="form-control" onchange="preview_image(event)">
                <img id="image" class="img-fluid">
                <input type="hidden" name="id" value="{{ $id }}">
            </div>
            <div class="col-12 d-flex shopping-box"> 
                <button class="ml-auto btn hvr-hover" style="color: #fff;" type="submit">Kirim Bukti Pembayaran</button> 
            </div>
        </form>
    </div>
</div>
<!-- End Cart -->

<input type="hidden" name="" class="form-control" id="count-cart" value="{{ $cart }}">
@endsection

@push('addon-script')
<script>
    function preview_image(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush