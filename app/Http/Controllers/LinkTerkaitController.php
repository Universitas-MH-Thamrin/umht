<?php

namespace App\Http\Controllers;

use App\DataTables\LinkTerkaitDataTable;
use App\Models\LinkTerkait;
use Illuminate\Http\Request;

class LinkTerkaitController extends Controller
{
    public function index(LinkTerkaitDataTable $dataTable)
    {
        return $dataTable->render('link_terkait.index', [
            'title' => 'List Link Terkait',
            'datatable' => true
        ]);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Link Terkait',
        ];
        return view('link_terkait.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['nullable'],
            'link' => ['nullable'],
            'visible' => ['nullable'],
        ]);

        try {
            $link_terkait = new LinkTerkait();
            $link_terkait->nama = $request->nama;
            $link_terkait->link = $request->link;
            $link_terkait->visible = $request->visible ? 1 : 0;

            $link_terkait->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat Link Terkait: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Link Terkait berhasi disimpan.');
    }

    public function edit($id)
    {
        $link_terkait = LinkTerkait::findOrFail($id);
        return view('link_terkait.edit', [
            'data' => $link_terkait,
            'title' => 'Edit Link Terkait',
        ]);
    }

    public function update(Request $request, $id)
    {
        $link_terkait = LinkTerkait::findOrFail($id);
        $request->validate([
            'nama' => ['nullable'],
            'link' => ['nullable'],
            'visible' => ['nullable'],
        ]);

        try {
            $link_terkait->nama = $request->nama;
            $link_terkait->link = $request->link;
            $link_terkait->visible = $request->visible ? 1 : 0;

            $link_terkait->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengubah data link_terkait.');
    }

    public function destroy($id)
    {
        $link_terkait = LinkTerkait::findOrFail($id);
        try {
            $link_terkait->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil menghapus link_terkait.');
    }
}
