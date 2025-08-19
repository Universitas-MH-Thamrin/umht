<?php

namespace App\Http\Controllers;

use App\DataTables\GaleriDataTable;
use App\DataTables\VideoDataTable;
use App\Models\Folder;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    public function index(VideoDataTable $dataTable)
    {
        return $dataTable->render('video.index', [
            'title' => 'List Video',
            'datatable' => true
        ]);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Video',
            'folders' => Folder::all()
        ];
        return view('video.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['nullable'],
            'visible' => ['nullable'],
            'file' => ['required', 'file', 'mimes:mp4,mov,avi', 'max:307200'],
        ]);

        try {
            $video = new Video();
            $video->nama = $request->nama;
            $video->folder_id = $request->folder_id;

            if ($request->hasFile('file')) {
                $filename = Str::random(32) . '.' . $request->file('file')->getClientOriginalExtension();
                $file_path = $request->file('file')->storeAs('public/file', $filename);
                $video->file = isset($file_path) ? $file_path : '';
            }

            $video->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat Video: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Video berhasi disimpan.');
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return view('video.edit', [
            'data' => $video,
            'folders' => Folder::all(),
            'title' => 'Edit Video',
        ]);
    }

    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);
        $request->validate([
            'nama' => ['nullable'],
            'file' => ['nullable', 'file', 'mimes:mp4,mov,avi', 'max:307200'],
        ]);

        try {
            $video->nama = $request->nama;
            $video->folder_id = $request->folder_id;

            if ($request->hasFile('file')) {
                if($video->file != '') {
                    try {
                        Storage::delete($video->file);
                    } catch (\Throwable $th) {
                    }
                }
                $filename = Str::random(32) . '.' . $request->file('file')->getClientOriginalExtension();
                $file_path = $request->file('file')->storeAs('public/file', $filename);
                $video->file = $request->file('file')->getClientOriginalName();
            }
            $video->file = isset($file_path) ? $file_path : $video->file;

            $video->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengubah data video.');
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        try {
            $video->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil menghapus video.');
    }

    public function fileStoreDropzone($folder_id)
    {
        $folder = Folder::findOrFail($folder_id);
        return view('video.dropzone', [
            'data' => $folder,
            'videos' => Video::where('folder_id', $folder_id)->orderBy('id', 'DESC')->get(),
            'title' => 'Dropzone Folder ' . $folder->nama,
        ]);
    }

    public function fileStore(Request $request, $folder_id)
    {
        $image = $request->file('file');

        $request->validate([
            'file' => ['required', 'file', 'mimes:webp,mp4,mov,avi', 'between:0,10048'],
        ]);

        $originalName = $image->getClientOriginalName();

        $file_path = $request->file('file')->storeAs('public/videos', $originalName);

        $video = new Video();
        $video->folder_id = $folder_id;
        $video->file = $file_path;
        $video->nama = $originalName;
        $video->dropzone = 1;
        $video->save();
        return response()->json(['success'=>$originalName]);
    }

    public function fileDestroy(Request $request)
    {
        $filename = $request->get('filename');
        $video = Video::where('nama',$filename)->first();
        $filename = $video->nama;
        try {
            Storage::delete($video->file);
        } catch (\Throwable $th) {
        }
        $video->delete();

        return $filename;
    }

    public function fileDestroyReload(Request $request)
    {
        $filename = $request->get('filename');
        $video = Video::where('nama',$filename)->first();
        $filename = $video->nama;
        try {
            Storage::delete($video->file);
            $video->delete();
            return redirect()->back()->with('success', 'file berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
