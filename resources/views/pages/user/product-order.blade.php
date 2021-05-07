@extends('layouts.user')

@section('title')
    <title>KulinaFood - Riwayat Pesanan</title>
@endsection

@section('content')
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Riwayat Pesanan</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active">Riwayat Pesanan</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Cart  -->
<div class="cart-box-main">
    <div class="container mt-3">
        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                            aria-expanded="true" aria-controls="collapseOne">
                            Pesanan Yang Belum Dibayar
                        </button>
                    </h5>
                </div>
                <div id="collapseOne" class="collapse mt-3 px-3" aria-labelledby="headingOne" data-parent="#accordion">
                    @forelse ( $items as $item )
                    <h1>No Pesanan : {{ $item->transaction_id }}</h1>
                    <form action="{{ route('paying-method', $item->id) }}" method="POST" class="mb-3">
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-main table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product as $aa)
                                            @if ($item->id == $aa->transaction_id)
                                            @foreach ($aa->product as $ite)
                                            <tr id="{{ $aa->id }}">
                                                <td class="name-pr">
                                                    <a href="{{ route('detail-product', $ite->id) }}">
                                                        {{ $ite->productName }}
                                                    </a>
                                                </td>
                                                <td class="price-pr">
                                                    <p>{{ rupiah($ite->price) }}</p>
                                                </td>
                                                <td class="quantity-box">
                                                    <p>{{ $aa->quantity }}</p>
                                                </td>
                                                <td class="total-pr">
                                                    <p>{{ rupiah($ite->price * $aa->quantity) }}</p>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                            @endforeach
                                            <tr>
                                                <td class="name-pr">

                                                </td>
                                                <td class="price-pr">

                                                </td>
                                                <td class="quantity-box">

                                                </td>
                                                <td class="total-pr">
                                                    <h2>{{ rupiah($item->total) }}</h2>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-12 d-flex shopping-box">
                                    <button class="ml-auto btn hvr-hover" style="color: #fff;">Selesaikan
                                        Pembayaran</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @empty
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-main table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="8" class="text-center py-5">
                                                <h3>Tidak ada pesanan yang belum dibayar</h3>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo"
                            aria-expanded="true" aria-controls="collapseOne">
                            Pesanan Yang Belum Dikonfirmasi Pembayarannya
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse mt-3 px-3" aria-labelledby="headingOne" data-parent="#accordion">
                    @forelse ( $items2 as $item )
                    <h1>No Pesanan : {{ $item->transaction_id }}</h1>
                    <div class="row">
                            <div class="col-lg-12">
                                <div class="table-main table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product as $aa)
                                            @if ($item->id == $aa->transaction_id)
                                            @foreach ($aa->product as $ite)
                                            <tr id="{{ $aa->id }}">
                                                <td class="name-pr">
                                                    <a href="{{ route('detail-product', $ite->id) }}">
                                                        {{ $ite->productName }}
                                                    </a>
                                                </td>
                                                <td class="price-pr">
                                                    <p>{{ rupiah($ite->price) }}</p>
                                                </td>
                                                <td class="quantity-box">
                                                    <p>{{ $aa->quantity }}</p>
                                                </td>
                                                <td class="total-pr">
                                                    <p>{{ rupiah($ite->price * $aa->quantity) }}</p>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                            @endforeach
                                            <tr>
                                                <td class="name-pr">

                                                </td>
                                                <td class="price-pr">

                                                </td>
                                                <td class="quantity-box">

                                                </td>
                                                <td class="total-pr">
                                                    <h2>{{ rupiah($item->total) }}</h2>
                                                </td>
                                                <td>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @empty
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-main table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="8" class="text-center py-5">
                                                <h3>Tidak ada pesanan yang belum dikonfirmasi pembayarnya</h3>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree"
                            aria-expanded="true" aria-controls="collapseOne">
                            Pesanan Yang Sedang Diproses
                        </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse mt-3 px-3" aria-labelledby="headingOne"
                    data-parent="#accordion">
                    @forelse ( $items3 as $item )
                    <h1>No Pesanan : {{ $item->transaction_id }}</h1>
                    <div class="row">
                            <div class="col-lg-12">
                                <div class="table-main table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product as $aa)
                                            @if ($item->id == $aa->transaction_id)
                                            @foreach ($aa->product as $ite)
                                            <tr id="{{ $aa->id }}">
                                                <td class="name-pr">
                                                    <a href="{{ route('detail-product', $ite->id) }}">
                                                        {{ $ite->productName }}
                                                    </a>
                                                </td>
                                                <td class="price-pr">
                                                    <p>{{ rupiah($ite->price) }}</p>
                                                </td>
                                                <td class="quantity-box">
                                                    <p>{{ $aa->quantity }}</p>
                                                </td>
                                                <td class="total-pr">
                                                    <p>{{ rupiah($ite->price * $aa->quantity) }}</p>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                            @endforeach
                                            <tr>
                                                <td class="name-pr">

                                                </td>
                                                <td class="price-pr">

                                                </td>
                                                <td class="quantity-box">

                                                </td>
                                                <td class="total-pr">
                                                    <h2>{{ rupiah($item->total) }}</h2>
                                                </td>
                                                <td>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @empty
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-main table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="8" class="text-center py-5">
                                                <h3>Tidak ada pesanan yang sedang diproses</h3>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFour"
                            aria-expanded="true" aria-controls="collapseOne">
                            Pesanan Yang Sedang Dikirim
                        </button>
                    </h5>
                </div>
                <div id="collapseFour" class="collapse mt-3 px-3" aria-labelledby="headingOne" data-parent="#accordion">
                    @forelse ( $items4 as $item )
                    <h1>No Pesanan : {{ $item->transaction_id }}</h1>
                    <h1>Kode Resi : {{ $item->resi_code }}</h1>
                    <div class="row">
                            <div class="col-lg-12">
                                <div class="table-main table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product as $aa)
                                            @if ($item->id == $aa->transaction_id)
                                            @foreach ($aa->product as $ite)
                                            <tr id="{{ $aa->id }}">
                                                <td class="name-pr">
                                                    <a href="{{ route('detail-product', $ite->id) }}">
                                                        {{ $ite->productName }}
                                                    </a>
                                                </td>
                                                <td class="price-pr">
                                                    <p>{{ rupiah($ite->price) }}</p>
                                                </td>
                                                <td class="quantity-box">
                                                    <p>{{ $aa->quantity }}</p>
                                                </td>
                                                <td class="total-pr">
                                                    <p>{{ rupiah($ite->price * $aa->quantity) }}</p>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                            @endforeach
                                            <tr>
                                                <td class="name-pr">

                                                </td>
                                                <td class="price-pr">

                                                </td>
                                                <td class="quantity-box">

                                                </td>
                                                <td class="total-pr">
                                                    <h2>{{ rupiah($item->total) }}</h2>
                                                </td>
                                                <td>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-12 d-flex shopping-box">
                                    <a class="ml-auto btn hvr-hover btn-sampai-tujuan mb-3" style="color: #fff;"
                                        href="{{ route('user.sampai-tujuan', $item->id) }}">Pesanan Sampai Tujuan</a>
                                </div>
                            </div>
                        </div>
                    @empty
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-main table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="8" class="text-center py-5">
                                                <h3>Tidak ada pesanan yang sedang dikirim</h3>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFive"
                            aria-expanded="true" aria-controls="collapseOne">
                            Pesanan Yang Sampai Tujuan
                        </button>
                    </h5>
                </div>
                <div id="collapseFive" class="collapse mt-3 px-3" aria-labelledby="headingOne" data-parent="#accordion">
                    @forelse ( $items5 as $item )
                    <h1>No Pesanan : {{ $item->transaction_id }}</h1>
                    <div class="row">
                            <div class="col-lg-12">
                                <div class="table-main table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                                <th>Review</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product as $aa)
                                            @if ($item->id == $aa->transaction_id)
                                            @foreach ($aa->product as $ite)
                                            <tr id="{{ $aa->id }}">
                                                <td class="name-pr">
                                                    <a href="{{ route('detail-product', $ite->id) }}">
                                                        {{ $ite->productName }}
                                                    </a>
                                                </td>
                                                <td class="price-pr">
                                                    <p>{{ rupiah($ite->price) }}</p>
                                                </td>
                                                <td class="quantity-box">
                                                    <p>{{ $aa->quantity }}</p>
                                                </td>
                                                <td class="total-pr">
                                                    <p>{{ rupiah($ite->price * $aa->quantity) }}</p>
                                                </td>
                                                <td>
                                                    @forelse ($aa->rating as $asas)
                                                    <p
                                                        style="white-space:nowrap; width: 100px; overflow:hidden; text-overflow: ellipsis;">
                                                        {{ $asas->ratingDescription }}</p>
                                                    @empty
                                                    <a class="ml-auto btn hvr-hover" style="color: #fff;"
                                                        href="{{ route('leave-review', $aa->id) }}">
                                                        Leave Review
                                                    </a>
                                                    @endforelse
                                                </td>
                                                <td>
                                                    @forelse ($aa->rating as $asas)
                                                    <a class="ml-auto btn hvr-hover" style="color: #fff;"
                                                        href="{{ route('edit-review', $asas->id) }}">
                                                        Edit Review
                                                    </a>
                                                    @empty
                                                        -
                                                    @endforelse
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                            @endforeach
                                            <tr>
                                                <td class="name-pr">

                                                </td>
                                                <td class="price-pr">

                                                </td>
                                                <td class="quantity-box">

                                                </td>
                                                <td class="total-pr">
                                                    <h2>{{ rupiah($item->total) }}</h2>
                                                </td>
                                                <td>

                                                </td>
                                                <td>
                                                    
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @empty
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-main table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="8" class="text-center py-5">
                                                <h3>Tidak ada pesanan yang sedang dikirim</h3>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('addon-script')
    <script>
        $('.btn-sampai-tujuan').on('click', function (event) {
            event.preventDefault(); // prevent form submit
            var form = $(this).attr('href'); 
            swal({
                title: 'Konfirmasi',
                text: "Pesan Sudah Sampai Tujuan?",
                type: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                closeOnConfirm: false,
                closeOnCancel: false,
                showLoaderOnConfirm: true
                },function (isConfirm) {
                if (isConfirm) {
                    window.location.href = form; // submitting the form when user press yes
                } else {
                    swal("Batal", "Data batal diubah", "error");
                }
            });
        });
    </script>
@endpush