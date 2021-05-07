@section('title')
    <title>Data Pesanan - Belum Bayar</title>
@endsection

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Pesanan Belum Di Bayar') }}
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
                                <th>Waktu</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">   
                            @php
                                $no = 0;
                            @endphp
                            @forelse ($items as $item)
                            @php
                                $no++;
                            @endphp
                            <tr class="text-center">
                                <td class="bg-gradient-gray">{{ $item->transaction_id }}</td>
                                <td>@foreach ($item->user as $aa)
                                    {{ $aa->nama_lengkap }}
                                @endforeach</td>
                                <td>{{ rupiah($item->total) }}</td>
                                <td>
                                    <script>
                                        CountDownTimer('{{$item->created_at}}', 'countdown{{ $no }}');
                                        function CountDownTimer(dt, id)
                                        {
                                            var end = new Date('{{$item->end_pay}}');
                                            var _second = 1000;
                                            var _minute = _second * 60;
                                            var _hour = _minute * 60;
                                            var _day = _hour * 24;
                                            var timer;
                                            function showRemaining() {
                                                var now = new Date();
                                                var distance = end - now;
                                                if (distance < 0) {
                                                    clearInterval(timer);
                                                    document.getElementById(id).innerHTML = '<b>Waktu Sudah Habis</b> ';
                                                    return;
                                                }
                                                var days = Math.floor(distance / _day);
                                                var hours = Math.floor((distance % _day) / _hour);
                                                var minutes = Math.floor((distance % _hour) / _minute);
                                                var seconds = Math.floor((distance % _minute) / _second);

                                                document.getElementById(id).innerHTML = hours + ' jam ';
                                                document.getElementById(id).innerHTML += minutes + ' menit ';
                                                document.getElementById(id).innerHTML += seconds + 'secs';
                                            }
                                            timer = setInterval(showRemaining, 1000);
                                        }
                                    </script>
                                    <div id="countdown{{ $no }}">
                                </td>
                                <td>
                                    <a href="{{ route('show-pesanan', $item->id) }}" class="btn btn-info" data-toggle="tooltip" data-placement="top"
                                        title="Edit Data">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('batal-pesanan', $item->id) }}" class="btn btn-danger btn-delete" data-toggle="tooltip" data-placement="top"
                                        title="Edit Data">
                                        <i class="fa fa-trash"></i>
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
                    text: "Yakin ingin membatalkan pesanan?",
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
        </script>
    @endpush
</x-app-layout>
