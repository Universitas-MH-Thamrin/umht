<?php

namespace App\Http\Controllers;

use App\DataTables\CarouselDataTable;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CarouselController extends Controller
{
    public function index(CarouselDataTable $dataTable)
    {
        return $dataTable->render('Carousel.index', [
            'title' => 'List Carousel',
            'datatable' => true
        ]);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Carousel',
        ];
        return view('Carousel.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['nullable'],
            'btn_link' => ['nullable'],
            'visible' => ['nullable'],
            'image' => ['required', 'file', 'mimes:jpg,jpeg,png,bmp,pdf,webp', 'between:0,2048'],
        ]);

        try {
            $carousel = new Carousel();
            $carousel->title = $request->title;
            $carousel->btn_link = $request->btn_link;
            $carousel->visible = $request->visible ? 1 : 0;

            if ($request->hasFile('image')) {
                $filename = Str::random(32) . '.' . $request->file('image')->getClientOriginalExtension();
                $image_path = $request->file('image')->storeAs('public/image', $filename);
                $carousel->image = isset($image_path) ? $image_path : '';
            }

            $carousel->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat Carousel: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Carousel berhasi disimpan.');
    }

    public function edit($id)
    {
        $carousel = Carousel::findOrFail($id);
        return view('Carousel.edit', [
            'data' => $carousel,
            'title' => 'Edit Carousel',
        ]);
    }

    public function update(Request $request, $id)
    {
        $carousel = Carousel::findOrFail($id);
        $request->validate([
            'title' => ['nullable'],
            'btn_link' => ['nullable'],
            'visible' => ['nullable'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,pdf,webp', 'between:0,2048'],
        ]);

        try {
            $carousel->title = $request->title;
            $carousel->btn_link = $request->btn_link;
            $carousel->visible = $request->visible ? 1 : 0;

            if ($request->hasFile('image')) {
                if($carousel->image != '') {
                    try {
                        Storage::delete($carousel->image);
                    } catch (\Throwable $th) {
                    }
                }
                $filename = Str::random(32) . '.' . $request->file('image')->getClientOriginalExtension();
                $image_path = $request->file('image')->storeAs('public/image', $filename);
                $carousel->image = $request->file('image')->getClientOriginalName();
            }
            $carousel->image = isset($image_path) ? $image_path : $carousel->image;

            $carousel->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengubah data Carousel.');
    }

    public function destroy($id)
    {
        $carousel = Carousel::findOrFail($id);
        try {
            $carousel->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil menghapus Carousel.');
    }
}
