<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function pesanan()
    {
        $items = Transaction::where('packet_status', 'Sampai Tujuan')->get();

        $pdf = PDF::loadview('pages.laporan.pesanan_laporan', [
            'items' => $items
        ])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-pesanan.pdf');
    }

    public function produk_tersedia()
    {
        $items = Product::where('stock', 1)->get();

        $pdf = PDF::loadview('pages.laporan.produk_tersedia', [
            'items' => $items
        ])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-produk-tersedia.pdf');
    }

    public function produk_habis()
    {
        $items = Product::where('stock', 0)->get();

        $pdf = PDF::loadview('pages.laporan.produk_habis', [
            'items' => $items
        ])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-produk-habis.pdf');
    }

    public function produk()
    {
        $items = Product::all();

        $pdf = PDF::loadview('pages.laporan.produk', [
            'items' => $items
        ])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-produk.pdf');
    }

    public function kategori()
    {
        $items = Categories::all();

        $pdf = PDF::loadview('pages.laporan.kategori', [
            'items' => $items
        ])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-kategori.pdf');
    }

    public function user()
    {
        $items = User::where('roles', 'USER')->get();

        $pdf = PDF::loadview('pages.laporan.user', [
            'items' => $items
        ])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-user.pdf');
    }

    public function admin()
    {
        $items = User::where('roles', 'ADMIN')->get();

        $pdf = PDF::loadview('pages.laporan.admin', [
            'items' => $items
        ])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-admin.pdf');
    }
}
