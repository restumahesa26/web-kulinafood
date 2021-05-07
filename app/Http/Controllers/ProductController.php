<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categories;
use App\Http\Requests\ProductRequest;
use App\Models\ProductImage;
use App\Models\ProductTransaction;
use App\Models\Rating;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Product::all();
        return view('pages.product.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Categories::all();
        return view('pages.product.create', [
            'items' => $items
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = array();

        $nameProduct = $request->productName;

        $check = Product::where('productName', $nameProduct)->first();

        if ($check == null) {
            foreach ($request->file('image') as $value) {
                $extension = $value->extension();
                $imageNames = uniqid('img_', microtime()) . '.' . $extension;
                Storage::putFileAs('public/images/gambar-produk', $value, $imageNames);
                $thumbnailpath = public_path('storage/images/gambar-produk/' . $imageNames);
                $img = Image::make($thumbnailpath)->resize(600, 400)->save($thumbnailpath);
                $data[] = $imageNames;
            }

            $item = new Product();
            $item->productName = $request->productName;
            $item->category_id = $request->category_id;
            $item->price = $request->price;
            $item->stock = $request->stock;
            $item->productDescription = $request->productDescription;
            $item->best_seller = 0;
            $item->new = 1;
            $item->weight = $request->weight;
            $item->save();

            foreach ($data as $produc) {
                $item->productImage()->attach($produc);
            }

            return redirect()->route('product.index')->with('success-create', 'Sukses');
        } else {
            return redirect()->back()->with('error-create', 'Error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Product::findOrFail($id);
        $img = ProductImage::where('product_id', $id)->get();
        $imgCount = ProductImage::where('product_id', $id)->count();
        $category = Categories::all();
        return view('pages.product.edit', [
            'item' => $item, 'category' => $category, 'img' => $img, 'imgCount' => $imgCount
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = array();

        $items = Product::findOrFail($id);

        $nameProduct = $request->productName;
        $nameProduct2 = $items->productName;
        $check = Product::where('productName', '=', $nameProduct)->first();

        if ($check == null || strtolower($nameProduct) == strtolower($nameProduct2)) {
            if ($request->has('image')) {
                foreach ($request->file('image') as $value) {
                    $extension = $value->extension();
                    $imageNames = uniqid('img_', microtime()) . '.' . $extension;
                    Storage::putFileAs('public/images/gambar-produk', $value, $imageNames);
                    $thumbnailpath = public_path('storage/images/gambar-produk/' . $imageNames);
                    $img = Image::make($thumbnailpath)->resize(600, 400)->save($thumbnailpath);
                    $data[] = $imageNames;
                }
            }

            $items->update([
                'productName' => $request->productName,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'weight' => $request->weight,
                'productDescription' => $request->productDescription
            ]);
            if ($request->has('image')) {
                $items->productImage()->detach();
                foreach ($data as $produc) {
                    $items->productImage()->attach($produc);
                }
            }
            return redirect()->route('product.index')->with('success-update', 'Sukses');
        } else {
            return redirect()->back()->with('error-update', 'Error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Product::findOrFail($id);

        $check = ProductTransaction::where('product_transaction_id', $id)->first();
        $check2 = Rating::where('product_id', $id)->first();

        if ($check == null && $check2 == null) {
            $item->productImage()->detach();
            $item->delete();

            return redirect()->route('product.index')->with('success-delete', 'Sukses');
        } else {
            return redirect()->back()->with('error-delete', 'Error');
        }
    }
}
