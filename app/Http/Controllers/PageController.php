<?php

namespace App\Http\Controllers;
use App\DataTables\PageDataTable;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index(PageDataTable $dataTable)
    {
        return $dataTable->render('page.index', [
            'title' => 'List Page',
            'datatable' => true
        ]);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Page',
        ];
        return view('page.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'konten' => ['nullable'],
        ]);

        try {
            $page = new Page();
            $page->nama = $request->nama;
            $page->konten = $request->konten;
            $page->slug = Str::slug($request->nama);

            $page->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat Page: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Page berhasi disimpan.');
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('page.edit', [
            'data' => $page,
            'title' => 'Edit Page',
        ]);
    }

    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $request->validate([
            'konten' => ['nullable'],
            'thumbnail' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,pdf,webp', 'between:0,2048'],
            'visible' => ['nullable'],
        ]);

        try {
            $page->nama = $request->nama;
            $page->konten = $request->konten;
            $page->slug = Str::slug($request->nama);

            $page->save();

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengubah data page.');
    }

    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        try {
            $page->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil menghapus page.');
    }
}
