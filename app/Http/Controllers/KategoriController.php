<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable)
    {
        return $dataTable->render('kategori.index', [
            'title' => 'List Kategori',
            'datatable' => true
        ]);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Kategori'
        ];
        return view('kategori.create', $data);
    }

    public function store(Request $request)
    {
        try {
            $kategori = new Kategori();
            $kategori->nama = $request->nama;
            $kategori->slug = Str::slug($request->nama);
            $kategori->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat Kategori: ' . $e->getMessage());
        }

        return redirect()->route('dashboard.kategori.index')->with('success', 'Kategori berhasi disimpan.');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);

        return view('kategori.edit', [
            'data' => $kategori,
            'title' => 'Edit Kategori'
        ]);
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        try {
            $kategori->nama = $request->nama;
            $kategori->slug = Str::slug($request->nama);
            $kategori->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengubah data Kategori.');
    }

    public function destroy(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        try {
            $kategori->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil menghapus Kategori.');
    }
}
