<?php

namespace App\Http\Controllers;

use App\DataTables\FaqDataTable;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FaqController extends Controller
{
    public function index(FaqDataTable $dataTable)
    {
        return $dataTable->render('faq.index', [
            'title' => 'List Faq',
            'datatable' => true
        ]);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Faq',
        ];
        return view('faq.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => ['nullable'],
            'jawaban' => ['nullable'],
            'urutan' => ['nullable'],
            'visible' => ['nullable'],
        ]);

        try {
            $faq = new Faq();
            $faq->pertanyaan = $request->pertanyaan;
            $faq->jawaban = $request->jawaban;
            $faq->urutan = $request->urutan;
            $faq->visible = $request->visible ? 1 : 0;

            $faq->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat Faq: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Faq berhasi disimpan.');
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('faq.edit', [
            'data' => $faq,
            'title' => 'Edit Faq',
        ]);
    }

    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);
        $request->validate([
            'pertanyaan' => ['nullable'],
            'jawaban' => ['nullable'],
            'urutan' => ['nullable'],
            'visible' => ['nullable'],
        ]);

        try {
            $faq->pertanyaan = $request->pertanyaan;
            $faq->jawaban = $request->jawaban;
            $faq->urutan = $request->urutan;
            $faq->visible = $request->visible ? 1 : 0;

            $faq->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengubah data faq.');
    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        try {
            $faq->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil menghapus faq.');
    }
}
