@section('title')
    <title>Data Metode Pembayaran - Tambah</title>
@endsection

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Paying Method') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="py-3 px-3 card-body">
                    <form action="{{ route('paying-method.store') }}" method="POST" class="form" id="form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="payingName">Metode Pembayaran</label>
                        <input id="payingName" type="text" class="form-control @error('payingName') is-invalid @enderror"
                            name="payingName" placeholder="Metode Pembayaran" value="{{ old('payingName') }}">
                        @error('payingName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="payingNumber">Nomor Pembayaran</label>
                        <input id="payingNumber" type="text" class="form-control @error('payingNumber') is-invalid @enderror"
                            name="payingNumber" placeholder="Nomor Pembayaran" value="{{ old('payingNumber') }}">
                        @error('payingNumber')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Atas Nama</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" placeholder="Atas Nama" value="{{ old('name') }}">
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
                    text: "Tambah data metode pembayaran?",
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
                swal("Gagal", "Nama Metode Pembayaran Sudah Tersedia", "error");                
            </script>
        @endif
        @if ($errors->any())
            <script>
                swal("Gagal", "Gagal Menambahkan Data Metode Pembayaran", "error");                
            </script>
        @endif
    @endpush
</x-app-layout>
