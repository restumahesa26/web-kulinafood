<?php

namespace App\Http\Controllers;

use App\Http\Requests\PayingMethodRequest;
use App\Models\PayingMethod;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PayingMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = PayingMethod::all();
        return view('pages.paying_method.index', [
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
        return view('pages.paying_method.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PayingMethodRequest $request)
    {
        $item = $request->get('payingName');
        $checkKategori = PayingMethod::where('payingName', '=', $item)->first();
        if ($checkKategori == null) {
            $data = $request->except(['_token']);
            PayingMethod::insert($data);
            return redirect()->route('paying-method.index')->with('success-create', 'Sukses');
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
        $item = PayingMethod::findOrFail($id);
        return view('pages.paying_method.edit', [
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
    public function update(PayingMethodRequest $request, $id)
    {
        $item = $request->get('payingName');
        $checkPayingName = PayingMethod::where('payingName', '=', $item)->first();
        $items = PayingMethod::findOrFail($id);
        $item2 = $items->payingName;
        if ($checkPayingName == null || strtolower($item) == strtolower($item2)) {
            $data = $request->except(['_token']);
            $items->update($data);
            return redirect()->route('paying-method.index')->with('success-update', 'Sukses');
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
        $items = PayingMethod::findOrFail($id);

        $check = Transaction::where('method_paying_id', $id)->first();

        if ($check == null) {
            $items->delete();
            return redirect()->route('paying-method.index')->with('success-delete', 'Sukses');
        } else {
            return redirect()->back()->with('error-delete', 'Error');
        }
    }
}
