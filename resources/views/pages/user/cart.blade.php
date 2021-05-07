@extends('layouts.user')

@section('title')
    <title>KulinaFood - Keranjang</title>
@endsection

@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Cart</h2>
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
            <form action="{{ route('update-cart') }}">
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
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalPrice = 0;
                                        $tax = 0;
                                        $totalQuantity = 0;
                                        $berat = 0
                                    @endphp
                                    @if ($cart > 0)
                                        @foreach ($product as $item)
                                            @foreach ($item->product as $it)
                                            <tr id="{{ $item->id }}">
                                                <td class="name-pr">
                                                <a href="{{ route('detail-product', $it->id) }}">
                                                    {{ $it->productName }}
                                                </a>
                                                </td>
                                                <input type="hidden" name="array2[]" value="{{ $item->id }}">
                                                <td class="price-pr">
                                                    <p>{{ rupiah($it->price) }}</p>
                                                </td>
                                                <td class="quantity-box">
                                                    <input type="number" size="4" value="{{ $item->quantity }}" min="1" step="1" class="c-input-text qty text" name="array[]">
                                                </td>
                                                <td class="total-pr">
                                                    <p>{{ rupiah($it->price * $item->quantity) }}</p>
                                                </td>
                                                @php
                                                    $totalPrice = $totalPrice + ( $it->price * $item->quantity );
                                                    $tax = ( ( 2 * $it->price / 100 ) * $item->quantity ) + $tax;
                                                    $totalQuantity = $totalQuantity + $item->quantity;
                                                    $berat = $berat + ( $it->weight * $item->quantity );
                                                @endphp
                                                <td class="remove-pr">
                                                    <a href="#" id="btn-btn-delete" data-ide="{{ $item->id }}" data-name="{{ $it->productName }}">
                                                <i class="fas fa-times"></i>
                                            </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endforeach
                                    @else
                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            <h3>Belum Ada Produk Dalam Keranjang</h3>
                                        </td>
                                    </tr>
                                    @endif
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if ($cart > 0)
                    <div class="row my-5">
                        <div class="col-lg-6 col-sm-6">
                            
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="update-box">
                                <input value="Update Cart" type="submit" class="btn-update-cart">
                            </div>
                        </div>
                    </div>
                @else
                <div class="row my-5">
                    <div class="d-flex justify-content-end col-lg-12 col-sm-6">
                        <div class="update-box">
                            <h2><a href="{{ route('product') }}" class="btn" style="background-color: #b0b435; color: #fff !important;">Lanjut Berbelanja</a></h2>
                        </div>
                    </div>
                </div>
                @endif
            </form>
        </div>
        @if ($cart > 0)
        <div class="container">
            <div class="row my-5">
                <div class="col-lg-8 col-sm-12"></div>
                <div class="col-lg-4 col-sm-12">
                    <div class="order-box">
                        <h3>Order summary</h3>
                        <div class="d-flex">
                            <h4>Sub Total</h4>
                            <div class="ml-auto font-weight-bold">{{ rupiah($totalPrice) }}</div>
                        </div>
                        <hr class="my-1">
                        <div class="d-flex">
                            <h4>Tax</h4>
                            <div class="ml-auto font-weight-bold">{{ rupiah($tax) }}</div>
                        </div>
                        <hr>
                        <div class="d-flex gr-total">
                            <h5>Grand Total</h5>
                            <div class="ml-auto h5">{{ rupiah($totalPrice + $tax) }}</div>
                        </div>
                        <hr> </div>
                </div>
                <div class="col-lg-8"></div>
                <div class="col-lg-4">
                    <form action="{{ route('view-checkout') }}" method="POST">
                        @csrf
                        @foreach ($product as $item)
                            @foreach ($item->product as $i)
                                <input type="hidden" name="product[]" value="{{ $i->id }}">
                                <input type="hidden" name="id[]" value="{{ $item->id }}">
                            @endforeach
                        @endforeach
                        <input type="hidden" name="total" value="{{ $totalPrice }}">
                        <input type="hidden" name="quantity" value="{{ $totalQuantity }}">
                        <input type="hidden" name="tax" value="{{ $tax }}">
                        <input type="hidden" name="berat" value="{{ $berat }}">
                        <div class="input-group-append">
                            <button class="btn" type="submit" style="padding: 15px; background-color:  #b0b435; color: #fff !important; font-size: 20px;">CHECKOUT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @else
            
        @endif
    </div>
    
    <input type="hidden" name="" class="form-control" id="count-cart" value="{{ $cart }}">
@endsection

@push('addon-script')
@if ($cart > 0)
    <script>
        $(document).on('click', '#btn-btn-delete', function (event) {
            var id = $(this).data("ide");
            var name = $(this).data("name");
            var countt = $('#count-cart').val();
            event.preventDefault(); // prevent form submit
            swal({
                title: 'Konfirmasi',
                text: "Hapus Produk "+name+" Dari Keranjang?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d01010',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Tidak',
                closeOnConfirm: false,
                closeOnCancel: false,
                showLoaderOnConfirm: true
                },function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: `{{ route('delete-cart', $item->id) }}`,
                        type: 'get',
                        data: {
                            'id' : id
                        },
                        dataType: 'json',
                        success: function (response) {
                            if (response != null) {
                                var number = parseInt(countt) - 1;
                                document.getElementById('count').innerHTML = number;
                                document.getElementById('count-cart').value = number;
                                $('#'+id).remove();
                                swal("Sukses", "Berhasil Menghapus Produk " +name+ " Dari Keranjang", "success");
                            }
                        }
                    }); // submitting the form when user press yes
                } else {
                    swal("Batal", "Produk batal dihapus dari keranjang", "error");
                }
            });
        });

        $('.btn-update-cart').on('click', function (event) {
            event.preventDefault(); // prevent form submit
            var form = event.target.form; 
            swal({
                title: "Konfirmasi",
                text: "Update Keranjang?",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#1597bb",
                confirmButtonText: "Update",
                cancelButtonText: "Batal",
                closeOnConfirm: true,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    form.submit();          // submitting the form when user press yes
                } else {
                    swal("Batal", "Keranjang batal di update", "error");
                }
            });
        });
    </script>
    @if (Session::get('success-update'))
        <script>
            swal("Sukses", "Berhasil Mengupdate Produk Di Keranjang", "success");                
        </script>
    @endif
@endif

@endpush