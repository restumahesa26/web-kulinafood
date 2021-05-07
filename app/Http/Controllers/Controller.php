<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use App\Models\Image;
use App\Models\Rating;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Images;

class Controller extends BaseController
{
    public function show_admin()
    {
        $items = User::all();
        return view('pages.data_admin.index', [
            'items' => $items
        ]);
    }

    public function set_admin($id)
    {
        $items = User::findOrFail($id);
        $items->roles = "ADMIN";
        $items->save();

        return redirect()->route('show-admin');
    }

    public function set_user($id)
    {
        $items = User::findOrFail($id);
        $items->roles = "USER";
        $items->save();

        return redirect()->route('show-admin');
    }

    public function delete_user($id)
    {
        $item = User::findOrFail($id);

        $check = Transaction::where('user_id', $id)->first();
        $check2 = Carts::where('user_id', $id)->first();
        $check3 = Rating::where('user_id', $id)->first();

        if ($check == null && $check2 == null && $check3 == null) {
            $item->delete();
            return redirect()->route('show-admin')->with('success-delete-user', 'Sukses');
        } else {
            return redirect()->back()->with('error-delete-user', 'Error');
        }
    }

    public function index_image()
    {
        $items = Image::all();
        return view('pages.data-image.index', [
            'items' => $items
        ]);
    }

    public function create_image()
    {
        return view('pages.data-image.create');
    }

    public function store_image(Request $request)
    {
        $file = $request->file('img_url');

        if ($request->has('img_url')) {
            $extension = $file->extension();
            $imageNames = uniqid('img_', microtime()) . '.' . $extension;
            Storage::putFileAs('public/images/gambar-instagram', $file, $imageNames);
            $thumbnailpath = public_path('storage/images/gambar-instagram/' . $imageNames);
            $img = Images::make($thumbnailpath)->resize(800, 800)->save($thumbnailpath);
            Image::insert([
                'img_url' => $imageNames
            ]);
            return redirect()->route('image.index')->with('success-create', 'Sukses');
        } else {
            return redirect()->back()->with('error-create', 'Error');
        }
    }

    public function destroy_image($id)
    {
        $item = Image::findOrFail($id);
        $item->delete();

        return redirect()->route('image.index')->with('success-delete', 'Sukses');
    }
}
