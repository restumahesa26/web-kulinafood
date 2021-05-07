@section('title')
    <title>Data Produk - Tambah</title>
@endsection

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Product') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="py-3 px-3 card-body">
                    <form action="{{ route('product.store') }}" method="POST" class="form" id="form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="productName">Nama Produk</label>
                        <input id="productName" type="text" class="form-control @error('productName') is-invalid @enderror"
                            name="productName" placeholder="Nama Produk" value="{{ old('productName') }}">
                        @error('productName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category">Kategori</label>
                        <select name="category_id" id="category" class="form-control">
                            @foreach ($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="weight">Berat <sup>*gram</sup></label>
                        <input id="weight" type="number" class="form-control @error('weight') is-invalid @enderror"
                            name="weight" placeholder="Berat" value="{{ old('weight') }}" min="1">
                        @error('weight')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input id="price" type="number" class="form-control @error('price') is-invalid @enderror"
                            name="price" placeholder="Harga" value="{{ old('price') }}" min="0">
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="stock">Stok</label>
                        <select name="stock" id="stock" class="form-control">
                            <option value="">Pilih Status Produk</option>
                            <option value="0">Off</option>
                            <option value="1">Ready</option>
                        </select>
                        @error('stock')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="productDescription">Deskripsi Produk</label>
                        <textarea name="productDescription" id="productDescription" cols="30" rows="10" class="form-control"></textarea>
                        @error('productDescription')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Masukkan Gambar Produk</label>
                        <input type="file" name="image[]" id="bukti" class="form-control" multiple required>
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
                    text: "Tambah data produk?",
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
                swal("Gagal", "Nama Produk Sudah Tersedia", "error");                
            </script>
        @endif
        @if ($errors->any())
            <script>
                swal("Gagal", "Gagal Menambahkan Data Produk", "error");                
            </script>
        @endif
    @endpush
</x-app-layout>
