@extends('layouts.user')

@section('title')
    <title>KulinaFood - Pembayaran</title>
@endsection

@section('content')
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Paying</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Order</a></li>
                    <li class="breadcrumb-item active">Paying</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Cart  -->
<div class="cart-box-main">
    <div class="container">
        <form action="{{ route('konfirmasi-order', $id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for=""><h3 style="font-size: 20px; color: red">Total Bayar : {{ rupiah($total->total) }}</h3></label>
            </div>
            <div class="form-group row">
                <div class="col-8">
                    <label><h3>Metode Pembayaran<span>*</span></h3></label>
                    <input type="hidden" name="id" value="{{ $id }}">
                    <select name="method_paying_id" id="method_paying_id" class="form-control">
                        <option value="">Pilih Metode Pembayaran</option>
                        @foreach ($pay as $item)
                            <option value="{{ $item->id }}">{{ $item->payingName }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <label for="" ><h3>Nomor Pembayaran</h3></label>
                    <h3 id="payingNumber">...</h3>
                </div>
                <div class="col-12 d-flex shopping-box"> 
                    <button class="ml-auto btn hvr-hover" style="color: #fff;">Bayar</button> 
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Cart -->

<input type="hidden" name="" class="form-control" id="count-cart" value="{{ $cart }}">
@endsection

@push('addon-script')
<script>
    $(document).on('change', '#method_paying_id', function (e) {
        var id = $(this).val();
        e.preventDefault();
        document.getElementById('payingNumber').innerHTML = "Searching...";
        $.ajax({
            url: `{{ route('check-paying') }}`,
            type: 'get',
            data: {
                'id': id
            },
            dataType: 'json',
            success: function (response) {
                if (response != null) {
                    document.getElementById('payingNumber').innerHTML = response;
                }
            }
        });
    });
</script>
@endpush