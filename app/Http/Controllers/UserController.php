<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Carts;
use App\Models\Categories;
use App\Models\Image;
use Intervention\Image\ImageManagerStatic as Images;
use App\Models\OrderImage;
use App\Models\PayingMethod;
use App\Models\ProductImage;
use App\Models\ProductTransaction;
use App\Models\Rating;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;

class UserController extends Controller
{
    public function index()
    {
        $item = Product::where('stock', '=', 1);
        $items = $item->where('best_seller', '=', 1)->orWhere('new', '=', 1)->get();
        $img = ProductImage::all();
        $category = Categories::all();
        $image = Image::all();
        if (Auth::user()) {
            $cart = Carts::where('user_id', '=', Auth::user()->id)->count();
        } else {
            $cart = 0;
        }
        return view('pages.user.home', [
            'items' => $items, 'cart' => $cart, 'category' => $category, 'img' => $img, 'image' => $image
        ]);
    }

    public function product()
    {
        $product = Product::where('stock', '=', 1)->paginate(10);
        $category = Categories::all();
        if (Auth::user()) {
            $cart = Carts::where('user_id', '=', Auth::user()->id)->count();
        } else {
            $cart = 0;
        }
        return view('pages.user.product', [
            'product' => $product, 'cart' => $cart, 'category' => $category
        ]);
    }

    public function product_category($id)
    {
        $product = Product::where('category_id', $id)->where('stock', '=', 1)->paginate(10);
        $category = Categories::all();
        if (Auth::user()) {
            $cart = Carts::where('user_id', '=', Auth::user()->id)->count();
        } else {
            $cart = 0;
        }
        return view('pages.user.product', [
            'product' => $product, 'cart' => $cart, 'category' => $category
        ]);
    }

    public function search_product(Request $request)
    {
        $query = strtolower($request->search);

        $product = Product::where('productName', 'like', '%' . $query . '%')->where('stock', '=', 1)->paginate(10);
        $category = Categories::all();
        if (Auth::user()) {
            $cart = Carts::where('user_id', '=', Auth::user()->id)->count();
        } else {
            $cart = 0;
        }
        return view('pages.user.product', [
            'product' => $product, 'cart' => $cart, 'category' => $category
        ]);
    }

    public function detail_product($id)
    {
        $ite = Product::findOrFail($id);
        $rating = Rating::where('product_id', $id)->get();
        $countProduct = 0;
        $countProduc = ProductTransaction::where('product_transaction_id', $id)->get();
        foreach ($countProduc as $key => $value) {
            $countProduct = $countProduct + $value->quantity;
        }
        $kategori = $ite->category_id;
        $product = Product::where('category_id', $kategori)->where('stock', '=', 1)->get();
        if (Auth::user()) {
            $cart = Carts::where('user_id', '=', Auth::user()->id)->count();
        } else {
            $cart = 0;
        }
        return view('pages.user.detail-product', [
            'ite' => $ite, 'cart' => $cart, 'product' => $product, 'rating' => $rating, 'countProduct' => $countProduct
        ]);
    }

    public function viewCart()
    {
        $product = Carts::where('user_id', '=', Auth::user()->id)->get();
        if (Auth::user()) {
            $cart = Carts::where('user_id', '=', Auth::user()->id)->count();
        } else {
            $cart = 0;
        }
        return view('pages.user.cart', [
            'cart' => $cart, 'product' => $product
        ]);
    }

    public function profileEdit(Request $request)
    {
        if (Auth::user()) {
            $cart = Carts::where('user_id', '=', Auth::user()->id)->count();
        } else {
            $cart = 0;
        }

        return view('pages.user.profile', [
            'user' => $request->user(), 'cart' => $cart
        ]);
    }

    public function profileUpdate(UpdateProfileRequest $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        $user->update([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'email' => $request->email,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'password' => Hash::make($request->password),
            'no_identitas' => $request->no_identitas
        ]);

        return redirect()->route('index');
    }

    public function get_province()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: a5717d59ee591f42826cb702743e514b"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //ini kita decode data nya terlebih dahulu
            $response = json_decode($response, true);
            //ini untuk mengambil data provinsi yang ada di dalam rajaongkir resul
            $data_pengirim = $response['rajaongkir']['results'];
            return $data_pengirim;
        }
    }

    public function get_city($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?&province=$id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: a5717d59ee591f42826cb702743e514b"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);
            $data_kota = $response['rajaongkir']['results'];
            return json_encode($data_kota);
        }
    }

    public function get_ongkir($destination, $weight, $courier)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=152&destination=$destination&weight=$weight&courier=$courier",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: a5717d59ee591f42826cb702743e514b"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);
            $data_ongkir = $response['rajaongkir']['results'];
            return json_encode($data_ongkir);
        }
    }

    public function checkout(Request $request)
    {
        if (Auth::user()) {
            $cart = Carts::where('user_id', '=', Auth::user()->id)->count();
        } else {
            $cart = 0;
        }

        $product = Carts::where('user_id', '=', Auth::user()->id)->get();

        $total = $request->total;
        $tax = $request->tax;
        $berat = $request->berat;

        $provinsi = $this->get_province();

        return view('pages.user.checkout', [
            'cart' => $cart, 'total' => $total, 'tax' => $tax, 'product' => $product, 'provinsi' => $provinsi,
            'berat' => $berat
        ]);
    }

    public function checkout_new($id)
    {
        if (Auth::user()) {
            $cart = Carts::where('user_id', '=', Auth::user()->id)->count();
        } else {
            $cart = 0;
        }

        $product = Product::findOrFail($id);

        $total = $product->price;
        $tax = 2 * $product->price / 100;
        $berat = $product->weight;
        $quantity = 1;

        $provinsi = $this->get_province();

        return view('pages.user.checkout2', [
            'cart' => $cart, 'total' => $total, 'tax' => $tax, 'product' => $product, 'berat' => $berat, 'provinsi' => $provinsi, 'quantity' => $quantity
        ]);
    }

    public function setOngkir(Request $request)
    {
        $value = $request->value;
        $tax = $request->tax;
        $price = $request->price;

        $total_price = $value + $tax + $price;
        return response()->json(['harga' => rupiah($value), 'harga2' => $value, 'total_price' => rupiah($total_price), 'total_price2' => $total_price]);
    }

    public function view_order()
    {
        if (Auth::user()) {
            $cart = Carts::where('user_id', '=', Auth::user()->id)->count();
        } else {
            $cart = 0;
        }
        $items = Transaction::where('pay_status', 'Menunggu Pembayaran')->where('user_id', Auth::user()->id)->get();
        $items2 = Transaction::where('pay_status', 'Menunggu Konfirmasi')->where('user_id', Auth::user()->id)->get();
        $items3 = Transaction::where('packet_status', 'Diproses')->where('user_id', Auth::user()->id)->get();
        $items4 = Transaction::where('packet_status', 'Dikirim')->where('user_id', Auth::user()->id)->get();
        $items5 = Transaction::where('packet_status', 'Sampai Tujuan')->where('user_id', Auth::user()->id)->get();
        $order = Transaction::where('user_id', Auth::user()->id)->count();
        $product = ProductTransaction::all();
        return view('pages.user.product-order', [
            'items' => $items, 'product' => $product, 'order' => $order, 'cart' => $cart, 'items2' => $items2, 'items3' => $items3, 'items4' => $items4, 'items5' => $items5
        ]);
    }

    public function paying_method(Request $request)
    {
        $id = $request->id;
        $pay = PayingMethod::all();
        $total = Transaction::findOrFail($id);
        if (Auth::user()) {
            $cart = Carts::where('user_id', '=', Auth::user()->id)->count();
        } else {
            $cart = 0;
        }
        return view('pages.user.finish_order', [
            'pay' => $pay, 'cart' => $cart, 'id' => $id, 'total' => $total
        ]);
    }

    public function cek_paying_number(Request $request)
    {
        $data = $request->id;
        $dataIn = PayingMethod::findOrFail($data);
        $item = $dataIn->payingNumber;

        return response()->json($item);
    }

    public function konfirmasi_order(Request $request)
    {
        $method_paying = $request->method_paying_id;
        $id = $request->id;
        $pay = PayingMethod::where('id', $method_paying)->first();
        if (Auth::user()) {
            $cart = Carts::where('user_id', '=', Auth::user()->id)->count();
        } else {
            $cart = 0;
        }
        return view('pages.user.konfirmasi_order', [
            'pay' => $pay, 'cart' => $cart, 'method_paying' => $method_paying, 'id' => $id
        ]);
    }

    public function proses_konfirmasi_order(Request $request)
    {
        $method_paying = $request->method_paying_id;
        $idd = $request->id;
        $image = $request->file('images_bukti');

        if ($request->has('images_bukti')) {
            $extension = $image->getClientOriginalExtension();
            $imageNames = uniqid('img_', microtime()) . '.' . $extension;
            Storage::putFileAs('public/images/bukti-order', $image, $imageNames);
            $thumbnailpath = public_path('storage/images/bukti-order/' . $imageNames);
            $img = Images::make($thumbnailpath)->resize(600, 400)->save($thumbnailpath);
        } else {
            return redirect()->back()->withInput()->with('error-image', 'Error');
        }

        $data2 = Transaction::find($idd);
        $data2->method_paying_id = $method_paying;
        $data2->pay_status = "Menunggu Konfirmasi";
        $data2->save();

        $data = new OrderImage();
        $data->transaction_id = $idd;
        $data->img_url = $imageNames;
        $data->save();

        return redirect()->route('view-order');
    }

    public function show_review($id)
    {
        if (Auth::user()) {
            $cart = Carts::where('user_id', '=', Auth::user()->id)->count();
        } else {
            $cart = 0;
        }
        $item = ProductTransaction::findOrFail($id);
        return view('pages.user.review', [
            'item' => $item, 'cart' => $cart
        ]);
    }

    public function post_review(Request $request, $id)
    {
        $idd = $id;
        $rating = $request->star;
        $ratingDesc = $request->review;
        $ided = $request->ided;

        $rate = new Rating();
        $rate->product_transaction_id = $idd;
        $rate->rating = $rating;
        $rate->ratingDescription = $ratingDesc;
        $rate->product_id = $ided;
        $rate->user_id = Auth::user()->id;
        $rate->save();

        return redirect()->route('view-order');
    }

    public function edit_review($id)
    {
        if (Auth::user()) {
            $cart = Carts::where('user_id', '=', Auth::user()->id)->count();
        } else {
            $cart = 0;
        }
        $item = Rating::findOrFail($id);
        return view('pages.user.edit-review', [
            'item' => $item, 'cart' => $cart
        ]);
    }

    public function update_review(Request $request, $id)
    {
        $rating = $request->star;
        $ratingDesc = $request->review;

        $item = Rating::findOrFail($id);
        $item->rating = $rating;
        $item->ratingDescription = $ratingDesc;
        $item->save();

        return redirect()->route('view-order');
    }

    public function sampai_tujuan_pesanan($id)
    {
        $items = Transaction::findOrFail($id);
        $items->packet_status = "Sampai Tujuan";
        $items->save();

        return redirect()->route('view-order');
    }
}
