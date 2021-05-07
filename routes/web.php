<?php

use App\Http\Controllers\UserController;
use App\Models\Categories;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'UserController@index')->name('index');

Route::get('/product', 'UserController@product')->name('product');

Route::get('/product_category/{id}', 'UserController@product_category')->name('product-category');

Route::get('/product_search', 'UserController@search_product')->name('search-product');

Route::get('/product/{id}', 'UserController@detail_product')->name('detail-product');

Route::group(['middleware' => 'auth:sanctum', 'verified'], function () {

    Route::get('profile', 'UserController@profileEdit')->name('profile.edit');

    Route::patch('profile/update', 'UserController@profileUpdate')->name('profile.update');

    Route::get('/cart/{id}', 'TransactionController@addCart')->name('add-cart');

    Route::get('/cart-cart/{id}', 'TransactionController@addCart2')->name('add-cart-2');

    Route::get('/delete-cart/{id}', 'TransactionController@deleteCart')->name('delete-cart');

    Route::get('/update-cart', 'TransactionController@updateCart')->name('update-cart');

    Route::get('/view-cart', 'UserController@viewCart')->name('view-cart');

    Route::post('/store-address', 'UserController@addressStore')->name('address.store');

    Route::get('/get-province', 'UserController@get_province')->name('get-province');

    Route::get('/set-ongkir', 'UserController@setOngkir')->name('set-ongkir');

    Route::get('/get_city/{id}', 'UserController@get_city')->name('get-city');

    Route::get('/buy_new/{id}', 'UserController@checkout_new')->name('buy-new');

    Route::get('/destination={city_destination}&weight={weight}&courier={courier}', 'UserController@get_ongkir');

    Route::post('/checkout-process', 'TransactionController@checkoutProcess')->name('process-checkout');

    Route::post('/checkout-process_new', 'TransactionController@checkoutProcess2')->name('process-checkout-2');

    Route::post('/checkout', 'UserController@checkout')->name('view-checkout');

    Route::get('/view-order', 'UserController@view_order')->name('view-order');

    Route::post('/pay_method/{id}', 'UserController@paying_method')->name('paying-method');

    Route::get('/check_pay_number', 'UserController@cek_paying_number')->name('check-paying');

    Route::post('/pay_method/konfirmasi-order/{id}', 'UserController@konfirmasi_order')->name('konfirmasi-order');

    Route::post('/pay_method/konfirmasi-order/proses/{id}', 'UserController@proses_konfirmasi_order')->name('proses-konfirmasi-order');

    Route::get('leave-review/{id}', 'UserController@show_review')->name('leave-review');

    Route::get('edit-review/{id}', 'UserController@edit_review')->name('edit-review');

    Route::post('post-review/{id}', 'UserController@post_review')->name('post-review');

    Route::put('update-review/{id}', 'UserController@update_review')->name('update-review');

    Route::get('/pesanan_sampai_tujuan/{id}', 'UserController@sampai_tujuan_pesanan')->name('user.sampai-tujuan');
});

Route::prefix('admin')
    ->middleware(['auth:sanctum', 'verified', 'admin'])
    ->group(function () {

        Route::get('/', function () {
            $product = Product::where('stock', '=', 0)->count();
            $product2 = Product::where('stock', '=', 1)->count();
            $category = Categories::all()->count();
            $user = User::where('roles', '=', 'USER')->count();
            $user2 = User::where('roles', '=', 'ADMIN')->count();
            $trans = Transaction::where('pay_status', 'Menunggu Pembayaran')->count();
            $trans2 = Transaction::where('pay_status', 'Menunggu Konfirmasi')->count();
            $trans3 = Transaction::where('packet_status', 'Diproses')->count();
            $trans4 = Transaction::where('packet_status', 'Dikirim')->count();
            $trans5 = Transaction::where('packet_status', 'Sampai Tujuan')->count();
            return view('dashboard', [
                'product' => $product, 'product2' => $product2, 'category' => $category, 'user' => $user, 'user2' => $user2,
                'trans' => $trans, 'trans2' => $trans2, 'trans3' => $trans3, 'trans4' => $trans4, 'trans5' => $trans5
            ]);
        })->name('dashboard');

        Route::resource('categories', 'CategoriesController');

        Route::resource('product', 'ProductController');

        Route::resource('paying-method', 'PayingMethodController');

        Route::get('/data-user-admin', 'Controller@show_admin')->name('show-admin');

        Route::get('/data-user-admin/set-admin/{id}', 'Controller@set_admin')->name('set-admin');

        Route::get('/data-user-admin/set-user/{id}', 'Controller@set_user')->name('set-user');

        Route::get('/data-user-admin/delete-user/{id}', 'Controller@delete_user')->name('delete-user');

        Route::get('/image-instagram', 'Controller@index_image')->name('image.index');

        Route::get('/image-instagram/create', 'Controller@create_image')->name('image.create');

        Route::post('/image-instagram/store', 'Controller@store_image')->name('image.store');

        Route::post('/image-instagram/delete/{id}', 'Controller@destroy_image')->name('image.destroy');

        Route::get('/pesanan-belum-dibayar', 'PesananController@pesanan_belum_bayar')->name('pesanan-belum-bayar');

        Route::get('/pesanan-belum-dikonfirmasi', 'PesananController@pesanan_belum_dikonfirmasi')->name('pesanan-belum-dikonfirmasi');

        Route::get('/pesanan-diproses', 'PesananController@pesanan_diproses')->name('pesanan-diproses');

        Route::get('/pesanan-dikirim', 'PesananController@pesanan_dikirim')->name('pesanan-dikirim');

        Route::get('/pesanan-sampai-tujuan', 'PesananController@pesanan_sampai_tujuan')->name('pesanan-sampai-tujuan');

        Route::get('/proses_pesanan/{id}', 'PesananController@proses_pesanan')->name('proses-pesanan');

        Route::get('/kirim_pesanan/{id}', 'PesananController@kirim_pesanan')->name('kirim-pesanan');

        Route::get('/set_new/{id}', 'PesananController@set_new')->name('set-new');

        Route::get('/set_best_seller/{id}', 'PesananController@set_best_seller')->name('set-best-seller');

        Route::get('/set_default/{id}', 'PesananController@set_default')->name('set-default');

        Route::get('/set_off_stock/{id}', 'PesananController@set_off')->name('set-off');

        Route::get('/set_ready/{id}', 'PesananController@set_ready')->name('set-ready');

        Route::get('/pesanan_sampai_tujuan/{id}', 'PesananController@sampai_tujuan_pesanan')->name('sampai-tujuan');

        Route::get('/pesanan-diproses/set_kode_resi/{id}', 'PesananController@view_resi_code')->name('view-resi-code');

        Route::post('/pesanan-diproses/make_kode_resi/{id}', 'PesananController@set_resi_code')->name('set-resi-code');

        Route::get('/show_bukti_pembayaran/{id}', 'PesananController@show_bukti_pembayaran')->name('show-bukti');

        Route::get('/batal_konfirmasi/{id}', 'PesananController@batal_konfirmasi')->name('batal-konfirmasi');

        Route::get('/batal_pesanan/{id}', 'PesananController@batal_pesanan')->name('batal-pesanan');

        Route::get('/lihat_pesanan/{id}', 'PesananController@show_pesanan')->name('show-pesanan');
    });
