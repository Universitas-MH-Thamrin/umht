<?php

namespace App\Http\Controllers;

use App\DataTables\HeroBannerDataTable;
use App\Models\HeroBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HeroBannerController extends Controller
{
    public function index(HeroBannerDataTable $dataTable)
    {
        return $dataTable->render('hero_banner.index', [
            'title' => 'List Hero Banner',
            'datatable' => true
        ]);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Hero Banner',
        ];
        return view('hero_banner.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['nullable'],
            'link' => ['nullable'],
            'visible' => ['nullable'],
            'image' => ['required', 'file', 'mimes:jpg,jpeg,png,bmp,pdf,webp', 'between:0,2048'],
        ]);

        try {
            $hero_banner = new HeroBanner();
            $hero_banner->nama = $request->nama;
            $hero_banner->title = $request->title;
            $hero_banner->subtitle = $request->subtitle;
            $hero_banner->desc = $request->desc;
            $hero_banner->link = $request->link;
            $hero_banner->visible = 0;

            if ($request->hasFile('image')) {
                $filename = Str::random(32) . '.' . $request->file('image')->getClientOriginalExtension();
                $image_path = $request->file('image')->storeAs('public/image', $filename);
                $hero_banner->image = isset($image_path) ? $image_path : '';
            }

            $hero_banner->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat HeroBanner: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'HeroBanner berhasi disimpan.');
    }

    public function edit($id)
    {
        $hero_banner = HeroBanner::findOrFail($id);
        return view('hero_banner.edit', [
            'data' => $hero_banner,
            'title' => 'Edit HeroBanner',
        ]);
    }

    public function update(Request $request, $id)
    {
        $hero_banner = HeroBanner::findOrFail($id);
        $request->validate([
            'title' => ['nullable'],
            'link' => ['nullable'],
            'visible' => ['nullable'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,pdf,webp', 'between:0,2048'],
        ]);

        try {
            $hero_banner->nama = $request->nama;
            $hero_banner->title = $request->title;
            $hero_banner->subtitle = $request->subtitle;
            $hero_banner->desc = $request->desc;
            $hero_banner->link = $request->link;

            if ($request->hasFile('image')) {
                if($hero_banner->image != '') {
                    try {
                        Storage::delete($hero_banner->image);
                    } catch (\Throwable $th) {
                    }
                }
                $filename = Str::random(32) . '.' . $request->file('image')->getClientOriginalExtension();
                $image_path = $request->file('image')->storeAs('public/image', $filename);
                $hero_banner->image = $request->file('image')->getClientOriginalName();
            }
            $hero_banner->image = isset($image_path) ? $image_path : $hero_banner->image;

            $hero_banner->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengubah data hero_banner.');
    }

    public function destroy($id)
    {
        $hero_banner = HeroBanner::findOrFail($id);
        try {
            $hero_banner->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil menghapus hero_banner.');
    }

    public function set_active(Request $request, $id)
    {
        $hero_banners = HeroBanner::all();
        foreach ($hero_banners as $item) {
            $item->visible = 0;
            $item->save();
        }

        $hero_banner = HeroBanner::findOrFail($id);

        try {
            $hero_banner->visible = 1;
            $hero_banner->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengatifkan Hero Banner.');
    }
}
