@section('title')
    <title>Data Produk - Edit</title>
@endsection

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Product') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="py-3 px-3 card-body">
                    <form action="{{ route('product.update', $item->id) }}" method="POST" class="form" id="form"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="productName">Nama Produk</label>
                        <input id="productName" type="text" class="form-control @error('productName') is-invalid @enderror"
                            name="productName" placeholder="Nama Produk" value="{{ $item->productName }}">
                        @error('productName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category">Kategori</label>
                        <select name="category_id" id="category" class="form-control">
                            @foreach ($category as $cate)
                                <option value="{{ $cate->id }}" @if ($cate->id == $item->category_id)
                                    selected
                                @endif>{{ $cate->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="weight">Berat <sup>*gram</sup></label>
                        <input id="weight" type="number" class="form-control @error('weight') is-invalid @enderror"
                            name="weight" placeholder="Berat" value="{{ $item->weight }}" min="1">
                        @error('weight')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input id="price" type="number" class="form-control @error('price') is-invalid @enderror"
                            name="price" placeholder="Harga" value="{{ $item->price }}" min="0">
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="productDescription">Deskripsi Produk</label>
                        <textarea name="productDescription" id="productDescription" cols="30" rows="10" class="form-control">{{ $item->productDescription }}</textarea>
                        @error('productDescription')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Masukkan Gambar Produk</label>
                        <input type="file" name="image[]" id="bukti" class="form-control" multiple>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-update">
                        Simpan
                    </button>
                </form>
                </div>
            </div>
            @if ($imgCount > 0)
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h3 class="text-center mb-3">Gambar Produk</h3>
                <div class="row justify-content-center mb-3  py-2 px-4">
                    @foreach ($img as $aa)
                        <div class="col-4">
                            <img src="{{ asset('storage/images/gambar-produk/'. $aa->product_image_id) }}" alt="" class="img-thumbnail">
                        </div>
                    @endforeach
                </div>
                
            </div>
            @endif
        </div>
    </div>
    @push('addon-script')
        <script>            
            $('.btn-update').on('click', function (event) {
                event.preventDefault(); // prevent form submit
                var form = event.target.form; 
                swal({
                    title: "Konfirmasi",
                    text: "Ubah data produk?",
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
                        swal("Batal", "Data batal diubah", "error");
                    }
                });
            });
        </script>
        @if (Session::get('error-update'))
            <script>
                swal("Gagal", "Nama Produk Sudah Tersedia", "error");                
            </script>
        @endif
        @if ($errors->any())
            <script>
                swal("Gagal", "Gagal Mengubah Data Produk", "error");                
            </script>
        @endif
    @endpush
</x-app-layout>
