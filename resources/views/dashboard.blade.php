@section('title')
    <title>Dashboard</title>
@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row justify-content-lg-center">
                <div class="col-lg-4 mb-3 mx-3 overflow-hidden shadow-xl sm:rounded-lg bg-primary text-white text-center">
                    <div class="row px-3 py-3">
                        <div class="col-6">
                            <h2>{{ $product }}</h2>
                            <span>Produk Habis</span>
                        </div>
                        <div class="col-6">
                            <h2>{{ $product2 }}</h2>
                            <span>Produk Tersedia</span>
                        </div>
                        <div class="col-12">
                            <span>Lihat Lebih</span>
                            <a href="{{ route('product.index') }}" class="btn btn-warning"><i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-3 mx-3 overflow-hidden shadow-xl sm:rounded-lg bg-success text-white text-center">
                    <div class="row px-3 py-3">
                        <div class="col-12">
                            <h2>{{ $category }}</h2>
                            <span>Jumlah Kategori</span>
                        </div>
                        <div class="col-12">
                            <span>Lihat Lebih</span>
                            <a href="{{ route('categories.index') }}" class="btn btn-warning"><i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-3 mx-3 overflow-hidden shadow-xl sm:rounded-lg bg-info text-white text-center">
                    <div class="row px-3 py-3">
                        <div class="col-6">
                            <h2>{{ $user }}</h2>
                            <span>User</span>
                        </div>
                        <div class="col-6">
                            <h2>{{ $user2 }}</h2>
                            <span>Admin</span>
                        </div>
                        <div class="col-12">
                            <span>Lihat Lebih</span>
                            <a href="{{ route('product.index') }}" class="btn btn-warning"><i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-3 mx-3 overflow-hidden shadow-xl sm:rounded-lg bg-danger text-white text-center">
                    <div class="row px-3 py-3">
                        <div class="col-12">
                            <h2>{{ $trans }}</h2>
                            <span>Pesanan Belum Dibayar</span>
                        </div>
                        <div class="col-12">
                            <span>Lihat Lebih</span>
                            <a href="{{ route('pesanan-belum-bayar') }}" class="btn btn-warning"><i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-3 mx-3 overflow-hidden shadow-xl sm:rounded-lg bg-warning text-white text-center">
                    <div class="row px-3 py-3">
                        <div class="col-12">
                            <h2>{{ $trans2 }}</h2>
                            <span>Pesanan Belum Dikonfirmasi</span>
                        </div>
                        <div class="col-12">
                            <span>Lihat Lebih</span>
                            <a href="{{ route('pesanan-belum-dikonfirmasi') }}" class="btn btn-warning"><i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-3 mx-3 overflow-hidden shadow-xl sm:rounded-lg bg-primary text-white text-center">
                    <div class="row px-3 py-3">
                        <div class="col-12">
                            <h2>{{ $trans3 }}</h2>
                            <span>Pesanan Sedang Diproses</span>
                        </div>
                        <div class="col-12">
                            <span>Lihat Lebih</span>
                            <a href="{{ route('pesanan-diproses') }}" class="btn btn-warning"><i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-3 mx-3 overflow-hidden shadow-xl sm:rounded-lg bg-secondary text-white text-center">
                    <div class="row px-3 py-3">
                        <div class="col-12">
                            <h2>{{ $trans4 }}</h2>
                            <span>Pesanan Sedang Dikirim</span>
                        </div>
                        <div class="col-12">
                            <span>Lihat Lebih</span>
                            <a href="{{ route('pesanan-dikirim') }}" class="btn btn-warning"><i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-3 mx-3 overflow-hidden shadow-xl sm:rounded-lg bg-success text-white text-center">
                    <div class="row px-3 py-3">
                        <div class="col-12">
                            <h2>{{ $trans5 }}</h2>
                            <span>Pesanan Sampai Tujuan</span>
                        </div>
                        <div class="col-12">
                            <span>Lihat Lebih</span>
                            <a href="{{ route('pesanan-sampai-tujuan') }}" class="btn btn-warning"><i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
