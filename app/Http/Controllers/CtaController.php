<?php

namespace App\Http\Controllers;

use App\DataTables\CtaDataTable;
use App\Models\Cta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CtaController extends Controller
{
    public function index(CtaDataTable $dataTable)
    {
        return $dataTable->render('cta.index', [
            'title' => 'List CTA / Poster Image',
            'datatable' => true
        ]);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah CTA / Poster Image',
        ];
        return view('cta.create', $data);
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
            $cta = new Cta();
            $cta->nama = $request->nama;
            $cta->link = $request->link;
            $cta->visible = 0;

            if ($request->hasFile('image')) {
                $filename = Str::random(32) . '.' . $request->file('image')->getClientOriginalExtension();
                $image_path = $request->file('image')->storeAs('public/image', $filename);
                $cta->image = isset($image_path) ? $image_path : '';
            }

            $cta->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat Cta: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Cta berhasi disimpan.');
    }

    public function edit($id)
    {
        $cta = Cta::findOrFail($id);
        return view('cta.edit', [
            'data' => $cta,
            'title' => 'Edit Cta',
        ]);
    }

    public function update(Request $request, $id)
    {
        $cta = Cta::findOrFail($id);
        $request->validate([
            'title' => ['nullable'],
            'link' => ['nullable'],
            'visible' => ['nullable'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,pdf,webp', 'between:0,2048'],
        ]);

        try {
            $cta->nama = $request->nama;
            $cta->link = $request->link;

            if ($request->hasFile('image')) {
                if($cta->image != '') {
                    try {
                        Storage::delete($cta->image);
                    } catch (\Throwable $th) {
                    }
                }
                $filename = Str::random(32) . '.' . $request->file('image')->getClientOriginalExtension();
                $image_path = $request->file('image')->storeAs('public/image', $filename);
                $cta->image = $request->file('image')->getClientOriginalName();
            }
            $cta->image = isset($image_path) ? $image_path : $cta->image;

            $cta->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengubah data cta.');
    }

    public function destroy($id)
    {
        $cta = Cta::findOrFail($id);
        try {
            $cta->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil menghapus cta.');
    }

    public function set_active(Request $request, $id)
    {
        // $ctas = Cta::all();
        // foreach ($ctas as $item) {
        //     $item->visible = 0;
        //     $item->save();
        // }

        $cta = Cta::findOrFail($id);

        try {
            $cta->visible = 1;
            $cta->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengatifkan CTA / Poster Image.');
    }
}
