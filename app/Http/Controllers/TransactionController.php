<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Carts;
use App\Models\ProductTransaction;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function addCart(Request $request)
    {
        $id = $request->id;
        $item = Product::findOrFail($id);

        $id_product = $item->id;
        $name = $item->productName;

        $idUser = Auth::user()->id;

        $check = Carts::where('user_id', $idUser)->where('product_id', $id_product)->first();

        if ($check == null) {
            $add_cart = new Carts;
            $add_cart->user_id = Auth::user()->id;
            $add_cart->product_id = $id_product;
            $add_cart->quantity = 1;
            $add_cart->save();

            return response()->json(['pesan' => 'success', 'name' => $name, 'quantity' => 1, 'value' => 1]);
        } else {
            $item = Carts::where('user_id', $idUser)->where('product_id', $id_product)->first();
            $quan = $item->quantity;
            $item->quantity = $quan + 1;
            $item->save();

            return response()->json(['pesan' => 'success', 'name' => $name, 'quantity' => 1, 'value' => 0]);
        }
    }

    public function addCart2(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        $item = Product::findOrFail($id);

        $idUser = Auth::user()->id;

        $id_product = $item->id;
        $name = $item->productName;

        $check = Carts::where('user_id', $idUser)->where('product_id', $id_product)->first();

        if ($check == null) {
            $add_cart = new Carts;
            $add_cart->user_id = Auth::user()->id;
            $add_cart->product_id = $id_product;
            $add_cart->quantity = $quantity;
            $add_cart->save();

            return response()->json(['pesan' => 'success', 'name' => $name, 'quantity' => $quantity, 'value' => 1]);
        } else {
            $item = Carts::where('user_id', $idUser)->where('product_id', $id_product)->first();
            $quan = $item->quantity;
            $item->quantity = $quan + $quantity;
            $item->save();

            return response()->json(['pesan' => 'success', 'name' => $name, 'quantity' => $quantity, 'value' => 0]);
        }
    }

    public function deleteCart(Request $request)
    {
        $id = $request->id;
        $itemm = Carts::findOrFail($id);
        $itemm->delete();

        return response()->json(['pesan' => 'success']);
    }

    public function updateCart(Request $request)
    {
        $count = array();
        $id = array();
        if ($request->array2 || $request->array) {
            $cart = $request->array;
            foreach ($cart as $file) {
                $count[] = $file;
            }
            $cartt = $request->array2;
            foreach ($cartt as $file) {
                $id[] = $file;
            }
            foreach ($id as $key => $counts) {
                $items = Carts::findOrFail($counts);
                $items->update([
                    'quantity' => $count[$key]
                ]);
            }
            return redirect()->route('view-cart')->with('success-update', 'Sukses');
        } else {
            return redirect()->route('view-cart')->with('success-update', 'Sukses');
        }
    }

    public function checkoutProcess(Request $request)
    {
        $product = array();

        if ($files = $request->product) {
            foreach ($files as $file) {
                $product[] = $file;
            }
        }

        $user_id = Auth::user()->id;

        $date = Carbon::now();
        $tgl = $date->toDateString();
        $time = $date->toTimeString();
        $tgl2 = Str::remove('-', $tgl);
        $time2 = Str::remove(':', $time);
        $endDate = $date->addHours(3);

        $transaction_id = "PS-" . $user_id . $tgl2 . $time2;

        $quantity = array();

        if ($files = $request->quantity) {
            foreach ($files as $file) {
                $quantity[] = $file;
            }
        }

        $provinsi = $request->provinsi;
        $kota = $request->kota;
        $ekspedisi = $request->kurir;
        $kode_pos = $request->kode_pos;
        $total_berat = $request->weight;
        $address = $request->address;
        $packet_status = "Bayar Pesanan Terlebih Dahulu";
        $resi_code = "Bayar Pesanan Terlebih Dahulu";
        $total = $request->total_price;
        $pay_status = "Menunggu Pembayaran";

        $transaction = new Transaction();
        $transaction->user_id = $user_id;
        $transaction->transaction_id = $transaction_id;
        $transaction->address = $address;
        $transaction->provinsi = $provinsi;
        $transaction->kota = $kota;
        $transaction->ekspedisi = $ekspedisi;
        $transaction->kode_pos = $kode_pos;
        $transaction->total_berat = $total_berat;
        $transaction->packet_status = $packet_status;
        $transaction->resi_code = $resi_code;
        $transaction->total = $total;
        $transaction->pay_status = $pay_status;
        $transaction->end_pay = $endDate;
        $transaction->save();

        foreach ($product as $key => $produc) {
            $pro = Product::find($produc);
            $transaction->productTransaction()->attach($pro, array('quantity' => $quantity[$key]));
        }

        $idCart = array();

        if ($files = $request->idee) {
            foreach ($files as $file) {
                $idCart[] = $file;
            }
        }

        foreach ($idCart as $dd) {
            $itemm = Carts::findOrFail($dd);
            $itemm->delete();
        }

        return redirect()->route('view-order');
    }

    public function checkoutProcess2(Request $request)
    {
        $user_id = Auth::user()->id;

        $date = Carbon::now();
        $tgl = $date->toDateString();
        $time = $date->toTimeString();
        $tgl2 = Str::remove('-', $tgl);
        $time2 = Str::remove(':', $time);
        $endDate = $date->addHours(3);

        $transaction_id = "PS-" . $user_id . $tgl2 . $time2;

        $provinsi = $request->provinsi;
        $quantity = $request->quantity;
        $kota = $request->kota;
        $ekspedisi = $request->kurir;
        $kode_pos = $request->kode_pos;
        $total_berat = $request->weight;
        $address = $request->address;
        $packet_status = "Bayar Pesanan Terlebih Dahulu";
        $resi_code = "Bayar Pesanan Terlebih Dahulu";
        $total = $request->total_price;
        $pay_status = "Menunggu Pembayaran";
        $method_paying_id = 1;
        $produc = $request->product;

        $transaction = new Transaction();
        $transaction->user_id = $user_id;
        $transaction->transaction_id = $transaction_id;
        $transaction->address = $address;
        $transaction->provinsi = $provinsi;
        $transaction->kota = $kota;
        $transaction->ekspedisi = $ekspedisi;
        $transaction->kode_pos = $kode_pos;
        $transaction->total_berat = $total_berat;
        $transaction->packet_status = $packet_status;
        $transaction->resi_code = $resi_code;
        $transaction->total = $total;
        $transaction->pay_status = $pay_status;
        $transaction->method_paying_id = $method_paying_id;
        $transaction->end_pay = $endDate;
        $transaction->save();

        $pro = Product::find($produc);
        $transaction->productTransaction()->attach($pro, array('quantity' => $quantity));

        return redirect()->route('view-order');
    }
}
