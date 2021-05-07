@section('title')
    <title>Data Produk - Index</title>
@endsection

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Products') }}
            </h2>
            <a href="{{ route('product.create') }}" class="btn btn-primary">Tambah Data Produk</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('laporan-produk') }}" class="btn btn-primary mb-3 mr-2">Buat Laporan Produk</a>
            <a href="{{ route('laporan-produk-tersedia') }}" class="btn btn-info mb-3 mr-2">Buat Laporan Produk Tersedia</a>
            <a href="{{ route('laporan-produk-habis') }}" class="btn btn-warning mb-3" style="color: #fff">Buat Laporan Produk Habis</a>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="table-responsive px-3 py-3">
                    <table class="table table-bordered table-hover" width="100%" cellspacing="0" id="product-table">
                        <thead>
                            <tr class="text-center bg-gradient-gray">
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Info</th>
                                <th>Harga</th>
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
                                <td class="@if ($item->stock == 0)
                                    bg-danger
                                @elseif ($item->new == 1)
                                    bg-primary
                                @elseif ($item->best_seller == 1)
                                    bg-success
                                @endif">{{ $no }}</td>
                                <td>{{ $item->productName }}</td>
                                <td>
                                    @if ($item->stock == 0)
                                        Out Of Stock
                                    @elseif ($item->new == 1)
                                        <span>New</span>
                                    @elseif ($item->best_seller == 1)
                                        <span>Best Seller</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $item->price }}</td>
                                <td>
                                    @if ($item->stock == 1)
                                        @if ($item->best_seller == 1 || $item->new == 1)
                                            <a href="{{ route('set-default', $item->id) }}" class="btn btn-outline-info btn-set-default"  data-toggle="tooltip" data-placement="top" title="Set Default">
                                                <i class="fa fa-filter" aria-hidden="true"></i>
                                            </a>
                                            @elseif ($item->best_seller == 0 || $item->new == 0)   
                                            <a href="{{ route('set-new', $item->id) }}" class="btn btn-primary btn-set-new" data-toggle="tooltip" data-placement="top" title="Set New">
                                                <i class="fa fa-bell" aria-hidden="true"></i>
                                            </a>
                                            <a href="{{ route('set-best-seller', $item->id) }}" class="btn btn-success btn-set-best-seller" data-toggle="tooltip" data-placement="top" title="Set Best Seller">
                                                <i class="fa fa-bookmark" aria-hidden="true"></i>
                                            </a>                                   
                                        @endif                                      
                                    @endif
                                    @if ($item->stock == 0)
                                        <a href="{{ route('set-ready', $item->id) }}" class="btn btn-outline-primary btn-set-ready" data-toggle="tooltip" data-placement="top" title="Set Ready">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        </a>
                                    @elseif ($item->stock == 1)
                                        <a href="{{ route('set-off', $item->id) }}" class="btn btn-outline-danger btn-set-off" data-toggle="tooltip" data-placement="top" title="Set Off" id="set-off">
                                            <i class="fa fa-ban" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('product.edit', $item->id) }}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit Data" id="edit-data">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                    <form action="{{ route('product.destroy', $item->id) }}" method="POST" class="d-inline btn-delete">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger" data-toggle="tooltip" data-placement="bottom"
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
            $(document).ready( function () {
                $('#product-table').DataTable();
                $('[data-toggle="tooltip"]').tooltip();
            });

            $('.btn-set-default').on('click', function (event) {
                event.preventDefault(); // prevent form submit
                var form = $(this).attr('href'); 
                swal({
                    title: 'Konfirmasi',
                    text: "Jadikan sebagai Produk Biasa",
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

            $('.btn-set-new').on('click', function (event) {
                event.preventDefault(); // prevent form submit
                var form = $(this).attr('href'); 
                swal({
                    title: 'Konfirmasi',
                    text: "Jadikan sebagai Produk Baru",
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

            $('.btn-set-best-seller').on('click', function (event) {
                event.preventDefault(); // prevent form submit
                var form = $(this).attr('href'); 
                swal({
                    title: 'Konfirmasi',
                    text: "Jadikan sebagai Produk Best Seller",
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

            $('.btn-set-ready').on('click', function (event) {
                event.preventDefault(); // prevent form submit
                var form = $(this).attr('href'); 
                swal({
                    title: 'Konfirmasi',
                    text: "Jadikan Stock Produk Tersedia",
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

            $('.btn-set-off').on('click', function (event) {
                event.preventDefault(); // prevent form submit
                var form = $(this).attr('href'); 
                swal({
                    title: 'Konfirmasi',
                    text: "Jadikan Stock Produk Habis",
                    type: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#d01010',
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

            $('.btn-delete').on('click', function (e) {
                e.preventDefault(); // prevent form submit
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
                        form.submit();        // submitting the form when user press yes
                    } else {
                        swal("Batal", "Data batal dihapus", "error");
                    }
                });
            });
        </script>
        @if (Session::get('success-create'))
            <script>
                swal("Sukses", "Berhasil Menambah Data Produk", "success");                
            </script>
        @endif
        @if (Session::get('success-update'))
            <script>
                swal("Sukses", "Berhasil Mengubah Data Produk", "success");                
            </script>
        @endif
        @if (Session::get('success-delete'))
            <script>
                swal("Sukses", "Berhasil Menghapus Data Produk", "success");                
            </script>
        @endif
        @if (Session::get('success-off'))
            <script>
            swal("Sukses", "Berhasil Mengubah Stok Produk Habis", "success");                
            </script>
        @endif
        @if (Session::get('success-ready'))
            <script>
            swal("Sukses", "Berhasil Mengubah Stok Produk Tersedia", "success");                
            </script>
        @endif
        @if (Session::get('success-set-new'))
            <script>
            swal("Sukses", "Berhasil Menjadikan Sebagai Produk Baru", "success");                
            </script>
        @endif
        @if (Session::get('success-set-best-seller'))
            <script>
            swal("Sukses", "Berhasil Menjadikan Sebagai Produk Best Seller", "success");                
            </script>
        @endif
        @if (Session::get('success-set-default'))
            <script>
            swal("Sukses", "Berhasil Menjadikan Sebagai Produk Biasa", "success");                
            </script>
        @endif
        @if (Session::get('error-delete'))
            <script>
                swal("Gagal", "Data Produk Sudah Dipakai", "error");                
            </script>
        @endif
    @endpush
</x-app-layout>