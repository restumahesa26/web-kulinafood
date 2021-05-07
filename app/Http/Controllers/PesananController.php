<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use App\Models\OrderImage;
use App\Models\Product;
use App\Models\ProductTransaction;
use App\Models\Rating;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function pesanan_belum_bayar()
    {
        $items = Transaction::where('pay_status', 'Menunggu Pembayaran')->get();
        return view('pages.pesanan_belum_bayar.index', [
            'items' => $items
        ]);
    }

    public function pesanan_belum_dikonfirmasi()
    {
        $items = Transaction::where('pay_status', 'Menunggu Konfirmasi')->get();
        return view('pages.pesanan_belum_dikonfirmasi.index', [
            'items' => $items
        ]);
    }

    public function pesanan_diproses()
    {
        $items = Transaction::where('packet_status', 'Diproses')->get();
        return view('pages.pesanan_diproses.index', [
            'items' => $items
        ]);
    }

    public function pesanan_dikirim()
    {
        $items = Transaction::where('packet_status', 'Dikirim')->get();
        return view('pages.pesanan_dikirim.index', [
            'items' => $items
        ]);
    }

    public function pesanan_sampai_tujuan()
    {
        $items = Transaction::where('packet_status', 'Sampai Tujuan')->get();
        return view('pages.pesanan_sampai_tujuan.index', [
            'items' => $items
        ]);
    }

    public function show_bukti_pembayaran($id)
    {
        $items = OrderImage::where('transaction_id', $id)->first();
        return view('pages.pesanan_belum_dikonfirmasi.show', [
            'items' => $items
        ]);
    }

    public function proses_pesanan($id)
    {
        $items = Transaction::findOrFail($id);
        $items->pay_status = "Bayar";
        $items->packet_status = "Diproses";
        $items->resi_code = "Sedang Diproses";
        $items->save();

        return redirect()->route('pesanan-belum-dikonfirmasi');
    }

    public function kirim_pesanan($id)
    {
        $items = Transaction::findOrFail($id);
        $items->packet_status = "Dikirim";
        $items->save();

        return redirect()->route('pesanan-diproses');
    }

    public function sampai_tujuan_pesanan($id)
    {
        $items = Transaction::findOrFail($id);
        $items->packet_status = "Sampai Tujuan";
        $items->save();

        return redirect()->route('pesanan-dikirim');
    }

    public function view_resi_code($id)
    {
        $item = Transaction::findOrFail($id);
        return view('pages.pesanan_diproses.edit', [
            'item' => $item
        ]);
    }

    public function set_resi_code(Request $request, $id)
    {
        $resi_code = $request->resi_code;
        $items = Transaction::findOrFail($id);
        $items->resi_code = $resi_code;
        $items->save();

        return redirect()->route('pesanan-diproses');
    }

    public function set_new($id)
    {
        $items = Product::findOrFail($id);
        $items->new = 1;
        $items->save();

        return redirect()->route('product.index')->with('success-set-new', 'Sukses');
    }

    public function set_best_seller($id)
    {
        $items = Product::findOrFail($id);
        $items->best_seller = 1;
        $items->save();

        return redirect()->route('product.index')->with('success-set-best-seller', 'Sukses');
    }

    public function set_default($id)
    {
        $items = Product::findOrFail($id);
        $items->best_seller = 0;
        $items->new = 0;
        $items->save();

        return redirect()->route('product.index')->with('success-set-default', 'Sukses');
    }

    public function set_off($id)
    {
        $items = Product::findOrFail($id);
        $items->stock = 0;
        $items->save();

        return redirect()->route('product.index')->with('success-off', 'Sukses');
    }

    public function set_ready($id)
    {
        $items = Product::findOrFail($id);
        $items->stock = 1;
        $items->save();

        return redirect()->route('product.index')->with('success-ready', 'Sukses');
    }

    public function batal_konfirmasi($id)
    {
        $items = Transaction::findOrFail($id);
        $items->pay_status = "Menunggu Pembayaran";
        $items->save();

        $bukti = OrderImage::where('transaction_id', $id);
        $bukti->delete();

        return redirect()->route('pesanan-belum-bayar');
    }

    public function batal_pesanan($id)
    {
        $items = Transaction::findOrFail($id);
        $bukti = ProductTransaction::where('transaction_id', $id);
        $bukti->delete();
        $items->delete();

        return redirect()->route('pesanan-belum-bayar');
    }

    public function show_pesanan($id)
    {
        $item = Transaction::findOrFail($id);
        $product = ProductTransaction::where('transaction_id', $id)->get();
        return view('pages.pesanan_belum_bayar.show', [
            'item' => $item, 'product' => $product
        ]);
    }
}
