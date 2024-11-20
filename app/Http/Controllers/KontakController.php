<?php

namespace App\Http\Controllers;

use App\DataTables\KontakDataTable;
use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index(KontakDataTable $dataTable)
    {
        return $dataTable->render('kontak.index', [
            'title' => 'List Kontak',
            'datatable' => true
        ]);
    }

    public function destroy($id)
    {
        $Kontak = Kontak::findOrFail($id);
        try {
            $Kontak->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil menghapus kontak.');
    }
}
