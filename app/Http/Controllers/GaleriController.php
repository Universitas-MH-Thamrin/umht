<?php

namespace App\Http\Controllers;

use App\DataTables\GaleriDataTable;
use App\Models\Folder;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    public function index(GaleriDataTable $dataTable)
    {
        return $dataTable->render('foto.index', [
            'title' => 'List Galeri',
            'datatable' => true
        ]);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Galeri',
            'folders' => Folder::all()
        ];
        return view('foto.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['nullable'],
            'btn_text' => ['nullable'],
            'btn_link' => ['nullable'],
            'visible' => ['nullable'],
            'file' => ['required', 'file', 'mimes:jpg,jpeg,png,bmp,webp,mp4', 'between:0,10048'],
        ]);

        try {
            $galeri = new Galeri();
            $galeri->user_id = Auth::user()->id;
            $galeri->nama = $request->nama;
            $galeri->folder_id = $request->folder_id;

            if ($request->hasFile('file')) {
                $filename = Str::random(32) . '.' . $request->file('file')->getClientOriginalExtension();
                $file_path = $request->file('file')->storeAs('public/file', $filename);
                $galeri->file = isset($file_path) ? $file_path : '';
            }

            $galeri->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat Galeri: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Galeri berhasi disimpan.');
    }

    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('foto.edit', [
            'data' => $galeri,
            'folders' => Folder::all(),
            'title' => 'Edit Galeri',
        ]);
    }

    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);
        $request->validate([
            'nama' => ['nullable'],
            'file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,webp', 'between:0,2048'],
        ]);

        try {
            $galeri->nama = $request->nama;
            $galeri->folder_id = $request->folder_id;

            if ($request->hasFile('file')) {
                if($galeri->file != '') {
                    try {
                        Storage::delete($galeri->file);
                    } catch (\Throwable $th) {
                    }
                }
                $filename = Str::random(32) . '.' . $request->file('file')->getClientOriginalExtension();
                $file_path = $request->file('file')->storeAs('public/file', $filename);
                $galeri->file = $request->file('file')->getClientOriginalName();
            }
            $galeri->file = isset($file_path) ? $file_path : $galeri->file;

            $galeri->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengubah data foto.');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);
        try {
            $galeri->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil menghapus foto.');
    }

    public function fileStoreDropzone($folder_id)
    {
        $folder = Folder::findOrFail($folder_id);
        return view('foto.dropzone', [
            'data' => $folder,
            'galeris' => Galeri::where('folder_id', $folder_id)->orderBy('id', 'DESC')->get(),
            'title' => 'Dropzone Folder ' . $folder->nama,
        ]);
    }

    public function fileStore(Request $request, $folder_id)
    {
        $image = $request->file('file');

        $request->validate([
            'file' => ['required', 'file', 'mimes:jpg,jpeg,png,bmp,webp,mp4', 'between:0,10048'],
        ]);

        $originalName = $image->getClientOriginalName();

        $file_path = $request->file('file')->storeAs('public/galeris', $originalName);

        $galeri = new Galeri();
        $galeri->folder_id = $folder_id;
        $galeri->file = $file_path;
        $galeri->nama = $originalName;
        $galeri->dropzone = 1;
        $galeri->save();
        return response()->json(['success'=>$originalName]);
    }

    public function fileDestroy(Request $request)
    {
        $filename = $request->get('filename');
        $galeri = Galeri::where('nama',$filename)->first();
        $filename = $galeri->nama;
        try {
            Storage::delete($galeri->file);
        } catch (\Throwable $th) {
        }
        $galeri->delete();

        return $filename;
    }

    public function fileDestroyReload(Request $request)
    {
        $filename = $request->get('filename');
        $galeri = Galeri::where('nama',$filename)->first();
        $filename = $galeri->nama;
        try {
            Storage::delete($galeri->file);
            $galeri->delete();
            return redirect()->back()->with('success', 'file berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
