<?php

namespace App\Http\Controllers;

use App\DataTables\FolderDataTable;
use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function index(FolderDataTable $dataTable)
    {
        return $dataTable->render('folder.index', [
            'title' => 'List Folder',
            'datatable' => true
        ]);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Folder',
        ];
        return view('folder.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['nullable'],
        ]);

        try {
            $folder = new Folder();
            $folder->nama = $request->nama;

            $folder->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat Folder: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Folder berhasi disimpan.');
    }

    public function edit($id)
    {
        $folder = Folder::findOrFail($id);
        return view('folder.edit', [
            'data' => $folder,
            'title' => 'Edit Folder',
        ]);
    }

    public function update(Request $request, $id)
    {
        $folder = Folder::findOrFail($id);
        $request->validate([
            'nama' => ['nullable'],
        ]);

        try {
            $folder->nama = $request->nama;

            $folder->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengubah data folder.');
    }

    public function destroy($id)
    {
        $folder = Folder::findOrFail($id);
        try {
            $folder->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil menghapus folder.');
    }
}
