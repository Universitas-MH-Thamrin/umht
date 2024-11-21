<?php

namespace App\Http\Controllers;

use App\DataTables\LayananDataTable;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LayananController extends Controller
{
    public function index(LayananDataTable $dataTable)
    {
        return $dataTable->render('Layanan.index', [
            'title' => 'List Layanan',
            'datatable' => true
        ]);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Layanan',
        ];
        return view('Layanan.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['nullable'],
            'deskripsi' => ['nullable'],
            'link' => ['nullable'],
            'visible' => ['nullable'],
            'icon' => ['required', 'file', 'mimes:jpg,jpeg,png,bmp,pdf,webp', 'between:0,2048'],
        ]);

        try {
            $layanan = new Layanan();
            $layanan->urutan = $request->urutan;
            $layanan->nama = $request->nama;
            $layanan->deskripsi = $request->deskripsi;
            $layanan->link = $request->link;
            $layanan->visible = $request->visible ? 1 : 0;

            if ($request->hasFile('icon')) {
                $filename = Str::random(32) . '.' . $request->file('icon')->getClientOriginalExtension();
                $icon_path = $request->file('icon')->storeAs('public/icon', $filename);
                $layanan->icon = isset($icon_path) ? $icon_path : '';
            }

            $layanan->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat Layanan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Layanan berhasi disimpan.');
    }

    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('Layanan.edit', [
            'data' => $layanan,
            'title' => 'Edit Layanan',
        ]);
    }

    public function update(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);
        $request->validate([
            'title' => ['nullable'],
            'deskripsi' => ['nullable'],
            'link' => ['nullable'],
            'visible' => ['nullable'],
            'icon' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,pdf,webp', 'between:0,2048'],
        ]);

        try {
            $layanan->urutan = $request->urutan;
            $layanan->nama = $request->nama;
            $layanan->deskripsi = $request->deskripsi;
            $layanan->link = $request->link;
            $layanan->visible = $request->visible ? 1 : 0;

            if ($request->hasFile('icon')) {
                if($layanan->icon != '') {
                    try {
                        Storage::delete($layanan->icon);
                    } catch (\Throwable $th) {
                    }
                }
                $filename = Str::random(32) . '.' . $request->file('icon')->getClientOriginalExtension();
                $icon_path = $request->file('icon')->storeAs('public/icon', $filename);
                $layanan->icon = $request->file('icon')->getClientOriginalName();
            }
            $layanan->icon = isset($icon_path) ? $icon_path : $layanan->icon;

            $layanan->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengubah data Layanan.');
    }

    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        try {
            $layanan->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil menghapus Layanan.');
    }
}
