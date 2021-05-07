@section('title')
    <title>Data Pesanan - Bukti Pembayaran</title>
@endsection

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Bukti Pembayaran') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('pesanan-belum-dikonfirmasi') }}" class="btn btn-info mb-3">Back</a>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <img src="{{ asset('storage/images/bukti-order/'. $items->img_url) }}" alt="" srcset="" style="width: 100%">
            </div>
        </div>
    </div>
</x-app-layout>
