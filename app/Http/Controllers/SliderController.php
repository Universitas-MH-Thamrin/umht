<?php

namespace App\Http\Controllers;

use App\DataTables\SliderDataTable;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('slider.index', [
            'title' => 'List Slider',
            'datatable' => true
        ]);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Slider',
        ];
        return view('slider.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['nullable'],
            'subtitle' => ['nullable'],
            'btn_text' => ['nullable'],
            'btn_link' => ['nullable'],
            'visible' => ['nullable'],
            'image' => ['required', 'file', 'mimes:jpg,jpeg,png,bmp,pdf,webp', 'between:0,2048'],
        ]);

        try {
            $slider = new Slider();
            $slider->title = $request->title;
            $slider->subtitle = $request->subtitle;
            $slider->btn_text = $request->btn_text;
            $slider->btn_link = $request->btn_link;
            $slider->visible = $request->visible ? 1 : 0;

            if ($request->hasFile('image')) {
                $filename = Str::random(32) . '.' . $request->file('image')->getClientOriginalExtension();
                $image_path = $request->file('image')->storeAs('public/image', $filename);
                $slider->image = isset($image_path) ? $image_path : '';
            }

            $slider->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat Slider: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Slider berhasi disimpan.');
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('slider.edit', [
            'data' => $slider,
            'title' => 'Edit Slider',
        ]);
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);
        $request->validate([
            'title' => ['nullable'],
            'subtitle' => ['nullable'],
            'btn_text' => ['nullable'],
            'btn_link' => ['nullable'],
            'visible' => ['nullable'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,pdf,webp', 'between:0,2048'],
        ]);

        try {
            $slider->title = $request->title;
            $slider->subtitle = $request->subtitle;
            $slider->btn_text = $request->btn_text;
            $slider->btn_link = $request->btn_link;
            $slider->visible = $request->visible ? 1 : 0;

            if ($request->hasFile('image')) {
                if($slider->image != '') {
                    try {
                        Storage::delete($slider->image);
                    } catch (\Throwable $th) {
                    }
                }
                $filename = Str::random(32) . '.' . $request->file('image')->getClientOriginalExtension();
                $image_path = $request->file('image')->storeAs('public/image', $filename);
                $slider->image = $request->file('image')->getClientOriginalName();
            }
            $slider->image = isset($image_path) ? $image_path : $slider->image;

            $slider->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengubah data Slider.');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        try {
            $slider->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil menghapus Slider.');
    }
}
