<?php

namespace App\Http\Controllers;

use App\DataTables\BankDataDataTable;
use App\Models\BankData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BankDataController extends Controller
{
    public function index(BankDataDataTable $dataTable)
    {
        return $dataTable->render('bank_data.index', [
            'title' => 'List BankData',
            'datatable' => true
        ]);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah BankData',
        ];
        return view('bank_data.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['nullable'],
            'visible' => ['nullable'],
            'file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,pdf,webp,docx,doc,xls,xlsx', 'between:0,2048'],
        ]);

        try {
            $BankData = new BankData();
            $BankData->nama = $request->nama;
            $BankData->visible = $request->visible ? 1 : 0;

            if ($request->hasFile('file')) {
                $filename = Str::random(32) . '.' . $request->file('file')->getClientOriginalExtension();
                $file_path = $request->file('file')->storeAs('public/file', $filename);
                $BankData->file = isset($file_path) ? $file_path : '';
            }

            $BankData->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat BankData: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'BankData berhasi disimpan.');
    }

    public function edit($id)
    {
        $BankData = BankData::findOrFail($id);
        return view('bank_data.edit', [
            'data' => $BankData,
            'title' => 'Edit BankData',
        ]);
    }

    public function update(Request $request, $id)
    {
        $BankData = BankData::findOrFail($id);
        $request->validate([
            'nama' => ['nullable'],
            'visible' => ['nullable'],
            'file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,pdf,webp,docx,doc,xls,xlsx', 'between:0,2048'],
        ]);

        try {
            $BankData->nama = $request->nama;
            $BankData->visible = $request->visible ? 1 : 0;

            if ($request->hasFile('file')) {
                if($BankData->file != '') {
                    try {
                        Storage::delete($BankData->file);
                    } catch (\Throwable $th) {
                    }
                }
                $filename = Str::random(32) . '.' . $request->file('file')->getClientOriginalExtension();
                $file_path = $request->file('file')->storeAs('public/file', $filename);
                $BankData->file = $request->file('file')->getClientOriginalName();
            }
            $BankData->file = isset($file_path) ? $file_path : $BankData->file;

            $BankData->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengubah data bank_data.');
    }

    public function destroy($id)
    {
        $BankData = BankData::findOrFail($id);
        try {
            $BankData->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil menghapus bank_data.');
    }
}
