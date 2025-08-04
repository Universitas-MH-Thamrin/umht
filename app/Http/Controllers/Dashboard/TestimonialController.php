<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Doctrine\DBAL\Schema\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $testimonials = Testimonial::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderByDesc('created_at')
            ->paginate(5);

        return view('testimonial.index', [
            'testimonials' => $testimonials,
            'title' => 'List Kata Alumni',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('testimonial.form', [
            'title' => 'Tambah Kata Alumni',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'profession' => ['nullable', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'image' => ['required', 'file', 'mimes:jpg,jpeg,png', 'between:0,2048'],
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $timestamp = now()->timestamp;
                $formattedName = Str::slug($request->name) . "-{$timestamp}." . $image->getClientOriginalExtension();

                $data['image'] = $image->storeAs('testimonial', $formattedName, 'public');
            } else {
                $data['image'] = null;
            }

            Testimonial::create($data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }

        return redirect()
            ->back()
            ->with('success', 'Berhasil menyimpan data.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('testimonial.form', [
            'testimonial' => $testimonial,
            'title' => 'Edit Kata Alumni',
        ]);
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        DB::beginTransaction();

        try {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'profession' => ['nullable', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:2048'],
            ]);

            $timestamp = now()->timestamp;
            $sluggedName = Str::slug($request->name);

            // Jika ada file gambar baru diunggah
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $formattedName = "{$sluggedName}-{$timestamp}." . $image->getClientOriginalExtension();
                $path = $image->storeAs('testimonial', $formattedName, 'public');

                // Hapus gambar lama jika ada
                if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
                    Storage::disk('public')->delete($testimonial->image);
                }

                $data['image'] = $path;
            } else {
                // Tidak upload gambar, tapi mungkin mengganti nama → rename file lama
                if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
                    $oldPath = $testimonial->image;
                    $extension = pathinfo($oldPath, PATHINFO_EXTENSION);
                    $newFileName = "{$sluggedName}-{$timestamp}.{$extension}";
                    $newPath = "testimonial/{$newFileName}";

                    // Pastikan direktori testimonial ada
                    Storage::disk('public')->makeDirectory('testimonial');

                    Storage::disk('public')->move($oldPath, $newPath);
                    $data['image'] = $newPath;
                } else {
                    // Tidak ada perubahan gambar
                    $data['image'] = $testimonial->image;
                }
            }

            // Update data testimonial
            $testimonial->update($data);

            DB::commit();

            return redirect()->back()->with('success', 'Berhasil menyimpan data.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy(Testimonial $testimonial)
    {
        DB::beginTransaction();

        try {

            if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
                Storage::disk('public')->delete($testimonial->image);
            }

            $testimonial->delete();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();

            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }

        return redirect()
            ->route('dashboard.testimonial.index')
            ->with('success', 'Berhasil menghapus data.');
    }
}
