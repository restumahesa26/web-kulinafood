@section('title')
    <title>Data Gambar - Index</title>
@endsection

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gambar') }}
            </h2>
            <a href="{{ route('image.create') }}" class="btn btn-primary">Tambah Gambar</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="table-responsive px-3 py-3">
                    <table class="table table-bordered table-hover" width="100%" cellspacing="0" id="product-table">
                        <thead>
                            <tr class="text-center bg-gradient-gray">
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @php
                                $no = 0;  
                            @endphp    
                            @forelse ($items as $item)
                            @php
                                $no++
                            @endphp
                            <tr class="text-center">
                                <td>{{ $no }}</td>
                                <td><img src="{{ asset('storage/images/gambar-instagram/'. $item->img_url) }}" alt="" style="width: 300px; height: 300px;"></td>
                                <td>                                    
                                    <form action="{{ route('image.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-danger btn-delete" data-toggle="tooltip" data-placement="bottom"
                                            title="Hapus Data" type="submit"><i class="fa fa-trash"></i>
                                        </button>
                                    </form>
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
                var form = event.target.form; 
                swal({
                    title: "Konfirmasi",
                    text: "Yakin ingin menghapus data?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d01010",
                    confirmButtonText: "Hapus!",
                    cancelButtonText: "Batal",
                    closeOnConfirm: false,
                    closeOnCancel: false,
                    showLoaderOnConfirm: true
                },
                function(isConfirm){
                    if (isConfirm) {
                        form.submit();          // submitting the form when user press yes
                    } else {
                        swal("Batal", "Data batal dihapus", "error");
                    }
                });
            });
        </script>
        @if (Session::get('success-create'))
            <script>
                swal("Sukses", "Berhasil Menambah Data Gambar", "success");                
            </script>
        @endif
        @if (Session::get('success-delete'))
            <script>
                swal("Sukses", "Berhasil Menghapus Data Gambar", "success");                
            </script>
        @endif
    @endpush
</x-app-layout>