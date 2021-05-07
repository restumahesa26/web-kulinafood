@section('title')
    <title>Data Gambar - Tambah</title>
@endsection

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Image') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="py-3 px-3 card-body">
                    <form action="{{ route('image.store') }}" method="POST" class="form" id="form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="img_url">Gambar</label>
                        <input id="img_url" type="file" class="form-control @error('img_url') is-invalid @enderror"
                            name="img_url" placeholder="Nama Kategori" value="{{ old('img_url') }}">
                        @error('img_url')
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
        @if (Session::get('success-create'))
            <script>
                swal("Sukses", "Berhasil Menambah Gambar", "success");                
            </script>
        @endif
        @if (Session::get('error-create'))
            <script>
                swal("Gagal", "Gagal Menambah Gambar", "error");                
            </script>
        @endif
    @endpush
</x-app-layout>
