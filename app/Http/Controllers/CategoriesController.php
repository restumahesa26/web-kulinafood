<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Http\Requests\CategoriesRequest;
use App\Models\Product;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Categories::all();
        return view('pages.categories.index', [
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
        return view('pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesRequest $request)
    {
        $item = $request->get('name');
        $checkKategori = Categories::where('name', '=', $item)->first();
        if ($checkKategori == null) {
            $data = $request->except(['_token']);
            Categories::insert($data);
            return redirect()->route('categories.index')->with('success-create', 'Sukses');
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
        $item = Categories::findOrFail($id);
        return view('pages.categories.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = $request->get('name');
        $checkKategori = Categories::where('name', '=', $item)->first();
        $items = Categories::findOrFail($id);
        $item2 = $items->name;
        if ($checkKategori == null || strtolower($item) == strtolower($item2)) {
            $data = $request->except(['_token']);
            $items->update($data);
            return redirect()->route('categories.index')->with('success-update', 'Sukses');
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
        $item = Categories::findOrFail($id);

        $check = Product::where('category_id', $id)->first();
        if ($check == null) {
            $item->delete();
            return redirect()->route('categories.index')->with('success-delete', 'Sukses');
        } else {
            return redirect()->back()->with('error-delete', 'Error');
        }
    }
}
