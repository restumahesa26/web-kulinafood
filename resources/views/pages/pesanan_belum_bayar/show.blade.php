@section('title')
    <title>Data Pesanan - Detail Pesanan</title>
@endsection

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detail Pesanan : {{ $item->transaction_id }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a class="btn btn-info mb-3" style="color: #fff" href="{{ url()->previous() }}">Back</a>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">                
                <div class="card-body px-3 py-3">
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>Nama</h5>
                        </div>
                        <div class="col-6">
                            @foreach ($item->user as $aa)
                            <h5>{{ $aa->nama_lengkap }}</h5>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-4">
                                    <h5>Tanggal Pesanan</h5>
                                </div>
                                <div class="col-6">
                                    <h5>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <h5>Jam Pesanan</h5>
                                </div>
                                <div class="col-6">
                                    <h5>{{ \Carbon\Carbon::parse($item->created_at)->format('H:i:s') }}</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <h5>Total Bayar</h5>
                                </div>
                                <div class="col-6">
                                    <h5 style="color: #ce1212"><b>{{ rupiah($item->total) }}</b></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-6">
                                    <h5>Alamat Pengiriman</h5>
                                </div>                    
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <span>Provinsi</span>
                                </div>
                                <div class="col-6">
                                    <span>{{ $item->provinsi }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <span>Kota / Kabupaten</span>
                                </div>
                                <div class="col-6">
                                    <span>{{ $item->kota }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <span>Alamat Lengkap</span>
                                </div>
                                <div class="col-6">
                                    <span>{{ $item->address }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <span>Ekspedisi</span>
                                </div>
                                <div class="col-6">
                                    <span style="text-transform: uppercase">{{ $item->ekspedisi }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <span>Kode Pos</span>
                                </div>
                                <div class="col-6">
                                    <span>{{ $item->kode_pos }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <h4>Produk</h4>
                    </div>                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Harga Satuan</th>
                                <th>Quantitas</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        @foreach ($product as $items)
                        <tbody>
                            <tr>
                                @foreach ($items->product as $aa)
                                    <td>{{ $aa->productName }}</td>
                                    <td>{{ rupiah($aa->price) }}</td>
                                    <td>{{ $items->quantity }} porsi</td>
                                    <td>{{ rupiah($items->quantity * $aa->price) }}</td>
                                @endforeach                                    
                            </tr>
                        </tbody>
                        @endforeach
                    </table> 
                    @if ($item->packet_status == 'Sampai Tujuan')
                        <div class="row">
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-6">
                                        <h5>Tanggal Sampai Tujuan</h5>
                                    </div>
                                    <div class="col-6">
                                        <h5>{{ \Carbon\Carbon::parse($item->updated_at)->format('d M Y') }}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5>Jam Sampai Tujuan</h5>
                                    </div>
                                    <div class="col-6">
                                        <h5>{{ \Carbon\Carbon::parse($item->updated_at)->format('H:i:s') }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif            
                </div>
            </div>
        </div>
    </div>
    @push('addon-script')

    @endpush
</x-app-layout>
