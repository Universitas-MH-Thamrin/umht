<?php

namespace App\Http\Controllers;

use App\DataTables\BeritaDataTable;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index(BeritaDataTable $dataTable)
    {
        return $dataTable->render('berita.index', [
            'title' => 'List Berita',
            'datatable' => true
        ]);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Berita',
            'kategoris' => Kategori::all()
        ];
        return view('berita.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'thumbnail' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,pdf,webp', 'between:0,2048'],
            'deskripsi' => ['nullable'],
            'visible' => ['nullable'],
        ]);

        try {
            $Berita = new Berita();
            $Berita->judul = $request->judul;
            $Berita->kategori_id = $request->kategori_id;
            $Berita->deskripsi = $request->deskripsi;
            $Berita->visible = $request->visible ? 1 : 0;
            $Berita->slug = Str::slug($request->judul);
            $Berita->user_id = Auth::user()->id;


            if ($request->hasFile('thumbnail')) {
                $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
                $thumbnail_path = $request->file('thumbnail')->storeAs('public/thumbnail', $filename);
                $Berita->thumbnail = isset($thumbnail_path) ? $thumbnail_path : '';
            }

            $Berita->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat Berita: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berita berhasi disimpan.');
    }

    public function edit($id)
    {
        $Berita = Berita::findOrFail($id);
        return view('berita.edit', [
            'data' => $Berita,
            'title' => 'Edit Berita',
            'kategoris' => Kategori::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $Berita = Berita::findOrFail($id);
        $request->validate([
            'deskripsi' => ['nullable'],
            'thumbnail' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,pdf,webp', 'between:0,2048'],
            'visible' => ['nullable'],
        ]);

        try {
            $Berita->judul = $request->judul;
            $Berita->kategori_id = $request->kategori_id;
            $Berita->deskripsi = $request->deskripsi;
            $Berita->visible = $request->visible ? 1 : 0;
            $Berita->slug = Str::slug($request->judul);
            $Berita->user_id = Auth::user()->id;

            if ($request->hasFile('thumbnail')) {
                if($Berita->thumbnail != '') {
                    try {
                        Storage::delete($Berita->thumbnail);
                    } catch (\Throwable $th) {
                    }
                }
                $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
                $thumbnail_path = $request->file('thumbnail')->storeAs('public/thumbnail', $filename);
                $Berita->thumbnail = $request->file('thumbnail')->getClientOriginalName();
            }
            $Berita->thumbnail = isset($thumbnail_path) ? $thumbnail_path : $Berita->thumbnail;

            $Berita->save();

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengubah data berita.');
    }

    public function destroy($id)
    {
        $Berita = Berita::findOrFail($id);
        try {
            $Berita->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil menghapus berita.');
    }

    public function ckeditor_upload(Request $request){
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();

            $request->validate([
                'upload' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,pdf,webp', 'between:0,2048'],
            ]);

            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('media'), $fileName);

            $url = asset('media/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);

        }
    }
}
