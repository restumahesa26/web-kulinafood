@section('title')
    <title>Data Metode Pembayaran - Index</title>
@endsection

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Paying Method') }}
            </h2>
            <a href="{{ route('paying-method.create') }}" class="btn btn-primary">Tambah Data Paying Method</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="table-responsive px-3 py-3">
                    <table class="table table-bordered table-hover" width="100%" cellspacing="0" id="paying-method-table">
                        <thead>
                            <tr class="text-center bg-gradient-gray">
                                <th>No</th>
                                <th>Metode Pembayaran</th>
                                <th>No Pembayaran</th>
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
                                <td class="bg-gradient-gray">{{ $no }}</td>
                                <td>{{ $item->payingName }}</td>
                                <td>{{ $item->payingNumber }}</td>
                                <td>
                                    <a href="{{ route('paying-method.edit', $item->id) }}" class="btn btn-info" data-toggle="tooltip" data-placement="top"
                                        title="Edit Data">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ route('paying-method.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-delete" data-toggle="tooltip" data-placement="bottom"
                                            title="Hapus Data">
                                            <i class="fa fa-trash"></i>
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
            $(document).ready( function () {
                $('#paying-method-table').DataTable();
            });
            
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
                swal("Sukses", "Berhasil Menambah Data Metode Pembayaran", "success");                
            </script>
        @endif
        @if (Session::get('success-update'))
            <script>
                swal("Sukses", "Berhasil Mengubah Data Metode Pembayaran", "success");                
            </script>
        @endif
        @if (Session::get('success-delete'))
            <script>
                swal("Sukses", "Berhasil Menghapus Data Metode Pembayaran", "success");                
            </script>
        @endif
        @if (Session::get('error-delete'))
            <script>
                swal("Gagal", "Data Metode Pembayaran Sudah Dipakai", "error");                
            </script>
        @endif
    @endpush
</x-app-layout>
