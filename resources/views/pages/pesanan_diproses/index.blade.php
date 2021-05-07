@section('title')
    <title>Data Pesanan - Diproses</title>
@endsection

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Pesanan Sedang Di Proses') }}
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
                                @if ($item->resi_code == "Sedang Diproses")
                                <td>
                                    <a href="{{ route('show-pesanan', $item->id) }}" class="btn btn-info"
                                        data-toggle="tooltip" data-placement="top" title="Edit Data">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('view-resi-code', $item->id) }}" class="btn btn-danger"
                                        data-toggle="tooltip">Masukkan Kode Resi !
                                    </a>
                                </td>
                                @else
                                <td>
                                    <a href="{{ route('show-pesanan', $item->id) }}" class="btn btn-info"
                                        data-toggle="tooltip" data-placement="top" title="Edit Data">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('kirim-pesanan', $item->id) }}" class="btn btn-primary btn-kirim">Kirim Pesanan
                                    </a>
                                </td>
                                @endif
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
            $('.btn-kirim').on('click', function (event) {
                event.preventDefault(); // prevent form submit
                var form = $(this).attr('href'); 
                swal({
                    title: 'Konfirmasi',
                    text: "Kirim Pesanan?",
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
