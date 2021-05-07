@section('title')
    <title>Data Pesanan - Belum Dikonfirmasi</title>
@endsection

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Pesanan Belum Di Konfirmasi') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="table-responsive px-3 py-3">
                    <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center bg-gradient-gray">
                                <th>No Pesanan</th>
                                <th>Nama</th>
                                <th>Total Bayar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">   
                            @forelse ($items as $item)
                            <tr class="text-center">
                                <td class="bg-gradient-gray">{{ $item->transaction_id }}</td>
                                <td>@foreach ($item->user as $aa)
                                    {{ $aa->nama_lengkap }}
                                @endforeach</td>
                                <td>{{ rupiah($item->total) }}</td>
                                <td>
                                    <a href="{{ route('show-bukti', $item->id) }}" class="btn btn-success">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ route('show-pesanan', $item->id) }}" class="btn btn-primary">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ route('proses-pesanan', $item->id) }}" class="btn btn-info btn-check">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ route('batal-konfirmasi', $item->id) }}" class="btn btn-danger btn-delete">
                                        <i class="fa fa-close" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    Data Kosong
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('addon-script')
        <script>
            $('.btn-delete').on('click', function (event) {
                event.preventDefault(); // prevent form submit
                var form = $(this).attr('href'); 
                swal({
                    title: "Konfirmasi",
                    text: "Yakin ingin membatalkan pembayaran?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d01010",
                    confirmButtonText: "Batalkan!",
                    cancelButtonText: "Tidak",
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
            $('.btn-check').on('click', function (event) {
                event.preventDefault(); // prevent form submit
                var form = $(this).attr('href'); 
                swal({
                    title: 'Konfirmasi',
                    text: "Terima Pembayaran dan Proses Pesanan?",
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
</x-app-layout>
