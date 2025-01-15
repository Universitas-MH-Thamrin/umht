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
    public function index(): View
    {
        $accreditations = Accreditation::query()->orderBy('created_at')->paginate(10)->withQueryString();

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
                'document' => ['required', 'file', 'mimes:pdf', 'between:0,2048'],
            ]);

            if ($request->hasFile('document')) {
                $file = $request->file('document');
                // Format nama file berdasarkan input `name`
                $formattedName = Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
                // Simpan file ke dalam folder `akreditasi` di disk `public`
                $data['document'] = $file->storeAs('public/akreditasi', $formattedName, 'public');
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
                'document' => ['nullable', 'file', 'mimes:pdf', 'between:0,2048'],
            ]);

            // Cek apakah ada file baru yang diunggah
            if ($request->hasFile('document')) {
                $file = $request->file('document');
                // Format nama file berdasarkan input `name`
                $formattedName = Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
                // Simpan file baru ke dalam folder `akreditasi` di disk `public`
                $data['document'] = $file->storeAs('public/akreditasi', $formattedName, 'public');

                // Hapus file lama jika ada
                if ($akreditasi->document && \Storage::disk('public')->exists($akreditasi->document)) {
                    \Storage::disk('public')->delete($akreditasi->document);
                }
            } else {
                // Pertahankan file lama jika tidak ada file baru
                $data['document'] = $akreditasi->document;
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
    public function destroy(Accreditation $akreditasi):RedirectResponse
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
            ->orderBy('name')
            ->paginate(10);

        return view('akreditasi', [
            'accreditations' => $accreditations,
            'title' => 'Sertifikat Akreditasi',
        ]);
    }
}
