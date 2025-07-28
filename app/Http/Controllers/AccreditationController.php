<?php

namespace App\Http\Controllers;

use App\Models\Accreditation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AccreditationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        // Search by name
        $search = $request->input('search');

        $accreditations = Accreditation::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('accreditation.index', [
            'accreditations' => $accreditations,
            'title' => 'List Akreditasi',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('accreditation.form', [
            'title' => 'Tambah Akreditasi',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'expirated' => ['required', 'date'],
                'document' => ['required', 'file', 'mimes:pdf', 'max:5120'],
            ]);

            if ($request->hasFile('document')) {
                $file = $request->file('document');
                // Format nama file berdasarkan input `name` dan tanggal input
                $timestamp = now()->timestamp;
                $formattedName = Str::slug($request->name) . "-{$timestamp}." . $file->getClientOriginalExtension();

                // Simpan file ke dalam folder `akreditasi` di disk `public`
                $data['document'] = $file->storeAs('akreditasi', $formattedName, 'public');
            } else {
                $data['document'] = null;
            }

            Accreditation::create($data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
        return redirect()->back()->with('success', 'Berhasil menyimpan data');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Accreditation  $accreditation
     * @return \Illuminate\Http\Response
     */
    public function edit(Accreditation $akreditasi): View
    {
        return view('accreditation.form', [
            'accreditation' => $akreditasi,
            'title' => 'Edit Akreditasi',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Accreditation  $akreditasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accreditation $akreditasi): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'expirated' => ['required', 'date'],
                'document' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],
            ]);

            // Cek apakah ada file baru yang diunggah
            if ($request->hasFile('document')) {
                $file = $request->file('document');
                $timestamp = now()->timestamp;
                $formattedName = Str::slug($request->name) . "-{$timestamp}." . $file->getClientOriginalExtension();
                $data['document'] = $file->storeAs('akreditasi', $formattedName, 'public');

                // Hapus file lama jika ada
                if ($akreditasi->document && \Storage::disk('public')->exists($akreditasi->document)) {
                    \Storage::disk('public')->delete($akreditasi->document);
                }
            } else {
                // Jika tidak ada file baru, tetapi nama berubah, ubah nama file lama
                if ($akreditasi->document) {
                    $oldFilePath = $akreditasi->document;
                    $oldFileExtension = pathinfo($oldFilePath, PATHINFO_EXTENSION);
                    $timestamp = now()->timestamp;
                    $newFileName = Str::slug($request->name) . "-{$timestamp}." . $oldFileExtension;
                    $newFilePath = 'akreditasi/' . $newFileName;

                    if (\Storage::disk('public')->exists($oldFilePath)) {
                        \Storage::disk('public')->move($oldFilePath, $newFilePath);
                        $data['document'] = $newFilePath;
                    } else {
                        $data['document'] = $akreditasi->document; // Pertahankan file lama jika tidak ditemukan
                    }
                }
            }

            // Update data
            $akreditasi->update($data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil memperbarui data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Accreditation  $accreditation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accreditation $akreditasi): RedirectResponse
    {
        DB::beginTransaction();

        try {
            // Hapus file dokumen jika ada
            if ($akreditasi->document && \Storage::disk('public')->exists($akreditasi->document)) {
                \Storage::disk('public')->delete($akreditasi->document);
            }

            // Hapus data dari database
            $akreditasi->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }

        return redirect()->route('dashboard.akreditasi.index')->with('success', 'Berhasil menghapus data');
    }

    public function getAll(Request $request): View
    {
        // Search by name
        $search = $request->input('search');

        $accreditations = Accreditation::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderByDesc('name')
            ->paginate(10);

        return view('akreditasi', [
            'accreditations' => $accreditations,
            'title' => 'Sertifikat Akreditasi',
        ]);
    }
}
