@section('title')
    <title>Data Admin</title>
@endsection

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Data User / Admin') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="table-responsive px-3 py-3">
                    <table class="table table-bordered table-hover" width="100%" cellspacing="0" id="categories-table">
                        <thead>
                            <tr class="text-center bg-gradient-gray">
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Role</th>
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
                                <td>{{ $item->nama_lengkap }}</td>
                                <td>{{ $item->roles }}</td>
                                <td>@if ($item->roles == "USER")
                                    <a href="{{ route('set-admin', $item->id) }}" class="btn btn-primary btn-set-admin"
                                        data-toggle="tooltip" data-placement="top" title="Edit Data">
                                        Set Admin
                                    </a>
                                    @elseif ($item->roles == "ADMIN")
                                    <a href="{{ route('set-user', $item->id) }}" class="btn btn-info btn-set-user"
                                        data-toggle="tooltip" data-placement="top" title="Edit Data">
                                        Set User
                                    </a>
                                @endif                                    
                                    <a href="{{ route('delete-user', $item->id) }}" class="btn btn-danger btn-delete"
                                        data-toggle="tooltip" data-placement="top" title="Edit Data">
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
        $(document).ready(function () {
            $('#categories-table').DataTable();
        });
    </script>
    <script>
        $('.btn-set-admin').on('click', function (event) {
            event.preventDefault(); // prevent form submit
            var form = $(this).attr('href'); 
            swal({
                title: 'Konfirmasi',
                text: "Jadikan User Sebagai Admin",
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
        $('.btn-set-user').on('click', function (event) {
            event.preventDefault(); // prevent form submit
            var form = $(this).attr('href'); 
            swal({
                title: 'Konfirmasi',
                text: "Jadikan Admin Sebagai User",
                type: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
                },function (isConfirm) {
                if (isConfirm) {
                    window.location.href = form; // submitting the form when user press yes
                } else {
                    swal("Batal", "Data batal diubah", "error");
                }
            });
        }); 
        $('.btn-delete').on('click', function (event) {
            event.preventDefault(); // prevent form submit
            var form = $(this).attr('href'); 
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
                },function (isConfirm) {
                if (isConfirm) {
                    window.location.href = form; // submitting the form when user press yes
                } else {
                    swal("Batal", "Data batal diubah", "error");
                }
            });
        });     
    </script>
    @if (Session::get('success-delete-user'))
        <script>
            swal("Sukses", "Berhasil Menghapus Data User", "success");                
        </script>
    @endif
    @if (Session::get('error-delete-user'))
        <script>
            swal("Gagal", "Data User Sudah Dipakai", "error");                
        </script>
    @endif
    @endpush
</x-app-layout>
