@section('title')
    <title>Data Kategori - Tambah</title>
@endsection

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Categories') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="py-3 px-3 card-body">
                    <form action="{{ route('categories.store') }}" method="POST" class="form" id="form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Kategori</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" placeholder="Nama Kategori" value="{{ old('name') }}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-create">
                        Simpan
                    </button>
                </form>
                </div>
            </div>
        </div>
    </div>
    @push('addon-script')
        <script>            
            $('.btn-create').on('click', function (event) {
                event.preventDefault(); // prevent form submit
                var form = event.target.form; 
                swal({
                    title: "Konfirmasi",
                    text: "Tambah data kategori?",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#1597bb",
                    confirmButtonText: "Simpan",
                    cancelButtonText: "Batal",
                    closeOnConfirm: false,
                    closeOnCancel: false,
                    showLoaderOnConfirm: true
                },
                function(isConfirm){
                    if (isConfirm) {
                        form.submit();          // submitting the form when user press yes
                    } else {
                        swal("Batal", "Data batal ditambah", "error");
                    }
                });
            });
        </script>
        @if (Session::get('error-create'))
            <script>
                swal("Gagal", "Nama Kategori Sudah Tersedia", "error");                
            </script>
        @endif
        @if ($errors->any())
            <script>
                swal("Gagal", "Gagal Menambahkan Data Kategori", "error");                
            </script>
        @endif
    @endpush
</x-app-layout>
