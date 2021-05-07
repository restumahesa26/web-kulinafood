@extends('layouts.user')

@section('title')
    <title>KulinaFood - Checkout</title>
@endsection

@section('content')
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Checkout</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<form class="needs-validation" action="{{ route('process-checkout-2') }}" method="POST">
    @csrf
    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Billing address</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" value="6" class="form-control" name="province_origin">
                                <input type="hidden" value="152" class="form-control" id="city_origin" name="city_origin">
                                <div class="form-group ">
                                    <label>Alamat<span>*</span>
                                    </label>
                                    <textarea name="address" class="form-control" rows="5"
                                        placeholder="Alamat Lengkap pengiriman"></textarea>
                                </div>
                                <div class="form-group form-group--inline">
                                    <label for="provinsi">Provinsi Tujuan</label>
                                    <select name="province_id" id="province_id" class="form-control">
                                        <option value="0">Provinsi Tujuan</option>
                                        @foreach ($provinsi as $row)
                                        <option value="{{ $row['province_id'] }}" namaprovinsi="{{ $row['province']}}" id="provinsii" data-nama="{{$row['province']}}">
                                            {{$row['province']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label>Kota Tujuan<span>*</span>
                                    </label>
                                    <select name="kota_id" id="kota_id" class="form-control" disabled>
                                        <option value="">Pilih Kota</option>
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label>Pilih Ekspedisi<span>*</span>
                                    </label>
                                    <select name="kurir" id="kurir" class="form-control" disabled>
                                        <option value="0">Pilih Kurir</option>
                                        <option value="jne">JNE</option>
                                        <option value="tiki">TIKI</option>
                                        <option value="pos">POS INDONESIA</option>
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label>Kode Pos<span>*</span>
                                    </label>
                                    <input type="text" name="kode_pos" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr class="mb-1">
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="shipping-method-box">
                                <div class="title-left">
                                    <h3>Shipping Method</h3>
                                </div>
                                <div class="mb-4 xxx">
                                </div>
                                <div class="col-12 d-flex shopping-box"> 
                                    <input type="button" class="ml-auto btn hvr-hover btn-check-ongkir" value="Pilih Jenis Pengiriman" style="color: #fff !important;">
                                </div>
                                <div class="col-12 d-flex shopping-box"> 
                                    <input type="button" class="ml-auto btn hvr-hover btn-clear-ongkir mt-2" value="Set Ulang Jenis Pengiriman" style="color: #fff !important;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="odr-box">
                                <div class="title-left">
                                    <h3>Shopping cart</h3>
                                </div>
                                <div class="rounded p-2 bg-light">
                                    <div class="media mb-2 border-bottom">
                                        <div class="media-body"> <a href="detail.html">{{ $product->productName }}</a>
                                            <div class="small text-muted">{{ rupiah($product->price) }}<span
                                                    class="mx-2">|</span> Qty: {{ $product->quantity }} <span
                                                    class="mx-2">|</span> Subtotal:
                                                {{ rupiah($quantity * $product->price) }} </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="order-box">
                                <div class="title-left">
                                    <h3>Your order</h3>
                                </div>
                                <div class="d-flex">
                                    <div class="font-weight-bold">Product</div>
                                    <div class="ml-auto font-weight-bold">Total</div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Sub Total</h4>
                                    <div class="ml-auto font-weight-bold">{{ rupiah($total) }}</div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Tax</h4>
                                    <div class="ml-auto font-weight-bold">{{ rupiah($tax) }}</div>
                                </div>
                                <div class="d-flex">
                                    <h4>Shipping Cost</h4>
                                    <div class="ml-auto font-weight-bold" id="ongkir"></div>
                                </div>
                                <hr>
                                <div class="d-flex gr-total">
                                    <h5>Grand Total</h5>
                                    <div class="ml-auto h5" id="total_price">{{ rupiah($tax + $total) }}</div>
                                </div>
                                <hr>
                            </div>
                            <div class="input-group-append">
                                <button class="btn" type="submit" style="padding: 15px; background-color:  #b0b435; color: #fff !important; font-size: 20px;">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="total" value="{{ $total }}" id="total_value">
    <input type="hidden" name="tax" value="{{ $tax }}" id="tax_value">
    <input type="hidden" name="weight" value="{{ $berat }}" id="weight_value">
    <input type="hidden" name="ongkir" id="ongkir_value">
    <input type="hidden" name="total_price" id="total_price_value">
    <input type="hidden" name="provinsi" value="" id="provinsi">
    <input type="hidden" name="kota" value="" id="kota">
    <input type="hidden" name="kurir" value="" id="kurir_value">
    <input type="hidden" name="quantity" value="{{ $quantity }}">
    <input type="hidden" name="product" value="{{ $product->id }}">
    <!-- End Cart -->
</form>
@endsection

@push('addon-script')
<script>
    $('#province_id').on("change", function(){
        var dat = $('select[name=province_id] option').filter(':selected').data("nama");
        document.getElementById('provinsi').value = dat;
        $(this).prop('disabled', true);
    });

    $(document).ready(function () {
        //ini ketika provinsi tujuan di klik maka akan eksekusi perintah yg kita mau
        //name select nama nya "provinve_id" kalian bisa sesuaikan dengan form select kalian
        $('select[name="province_id"]').on('change', function () {
            // kita buat variable provincedid untk menampung data id select province
            let provinceid = $(this).val();
            var dat = $('select[name=kota_id] option').filter(':selected').data("nama");
            document.getElementById('kota').value = dat;
            //kita cek jika id di dpatkan maka apa yg akan kita eksekusi
            if (provinceid) {
                // jika di temukan id nya kita buat eksekusi ajax GET
                jQuery.ajax({
                    // url yg di root yang kita buat tadi
                    url: "/get_city/" + provinceid,
                    // aksion GET, karena kita mau mengambil data
                    type: 'GET',
                    // type data json
                    dataType: 'json',
                    // jika data berhasil di dapat maka kita mau apain nih
                    success: function (data) {
                        // jika tidak ada select dr provinsi maka select kota kososng / empty
                        $('select[name="kota_id"]').empty();
                        // jika ada kita looping dengan each
                        $.each(data, function (key, value) {
                            // perhtikan dimana kita akan menampilkan data select nya, di sini saya memberi name select kota adalah kota_id
                            $('select[name="kota_id"]').append('<option value="' + value.city_id + '" namakota="' + value.type + ' ' + value.city_name + '" data-nama="' + value.city_name + '">' + value.type + ' ' + value.city_name + '</option>');
                        });
                        var dat = $('select[name=kota_id] option').filter(':selected').data("nama");
                        document.getElementById('kota').value = dat;
                        $(this).prop('disabled', true);
                        $("#kota_id").prop('disabled', false);
                    }
                });
            } else {
                $('select[name="kota_id"]').empty();
            }
        });
    });

    $('#kota_id').on("change", function(){
        var dat = $('select[name=kota_id] option').filter(':selected').data("nama");
        document.getElementById('kota').value = dat;
        $(this).prop('disabled', true);
        $("#kurir").prop('disabled', false);
    });

    $('#kurir').on("change", function(){
        var dat = $('select[name=kurir] option').filter(':selected').val();
        document.getElementById('kurir_value').value = dat;
        $(this).prop('disabled', true);
    });

    $('select[name="kurir"]').on('change', function(){
        // kita buat variable untuk menampung data data dari  inputan
        // name kota_id di dapat dari select text name kota_id
        let destination = $("select[name=kota_id]").val();
        // name kurir di dapat dari select text name kurir
        let courier = $("select[name=kurir]").val();
        // name weight di dapat dari select text name weight
        let weight = $("input[name=weight]").val();
        // alert(courier);
        if(courier){
            jQuery.ajax({
                url: "/destination=" + destination + "&weight=" + weight + "&courier=" + courier,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('select[name="layanan"]').empty();
                    $('.xxx').empty();
                    // ini untuk looping data result nya
                    var no =0;
                    $.each(data, function (key, value) {
                        // ini looping data layanan misal jne reg, jne oke, jne yes
                        $.each(value.costs, function (key1, value1) {
                            // ini untuk looping cost nya masing masing
                            // silahkan pelajari cara menampilkan data json agar lebi paham
                            $.each(value1.cost, function (key2, value2) {
                                $('.xxx').append('<div class="custom-control custom-radio"><input class="form-check-input shippingOption" id="shippingOption" type="radio" name="shippingOption" value="' + value2.value + '"> <label class="form-check-label">' + value1.service + '-' + value1.description + '</label><span class="float-right font-weight-bold">' +  value2.value + '</span></div><div class="ml-4 mb-2 small">( ' + value2.etd + ' hari)</div>');
                            });
                            $(this).prop('disabled', true);
                        });
                    });
                }
            });
        } else {
            $('select[name="layanan"]').empty();
            $('.xxx').empty();
        }
    });

    $(".btn-check-ongkir").on("click", function() {
        var ele = document.getElementsByName('shippingOption');
        var tax = $('#tax_value').val();
        var total_price = $('#total_value').val();
        for(i = 0; i < ele.length; i++) {
            if(ele[i].checked){
                $.ajax({
                    url: `{{ route('set-ongkir') }}`,
                    type: 'get',
                    data: {
                        'value' : ele[i].value,
                        'tax' : tax,
                        'price' : total_price
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response != null) {
                            document.getElementById('ongkir').innerHTML = response.harga;
                            document.getElementById('ongkir_value').value = response.harga2;
                            document.getElementById('total_price').innerHTML = response.total_price;
                            document.getElementById('total_price_value').value = response.total_price2;
                        }
                    }
                });
            }
        }
    });

    $(".btn-clear-ongkir").on("click", function() {
        $("#province_id").prop('disabled', false);
        $("#province_id").val("0");
        $("#kota_id").prop('disabled', false);
        $("#kota_id").empty();
        $("#kota_id").append('<option value="0">Pilih Kota</option>');
        $("#kota_id").val("0");
        $("#kurir").prop('disabled', false);
        $("#kurir").val("0");
    })
</script>

@endpush