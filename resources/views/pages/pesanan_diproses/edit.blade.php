@section('title')
    <title>Data Pesanan - Kode Resi</title>
@endsection

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Masukkan Kode Resi') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="py-3 px-3 card-body">
                    <form action="{{ route('set-resi-code', $item->id) }}" method="POST" class="form" id="form">
                        @csrf
                        <div class="form-group">
                            <label for="resi_code">Kode Resi</label>
                            <input id="resi_code" type="text" class="form-control @error('resi_code') is-invalid @enderror"
                                name="resi_code" placeholder="Masukkan Kode Resi" value="{{ old('resi_code') }}">
                            @error('resi_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
