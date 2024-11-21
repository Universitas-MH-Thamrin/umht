<?php

namespace App\Http\Controllers;

use App\DataTables\DynamicMenuDataTable;
use App\Models\DynamicMenu;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DynamicMenuController extends Controller
{
    public function index(DynamicMenuDataTable $dataTable)
    {
        return $dataTable->render('dynamic_menu.index', [
            'title' => 'List Menu',
            'datatable' => true
        ]);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Menu',
            'pages' => Page::all(),
            'primary_menus' => DynamicMenu::where('level', 1)->get(),
            'secondary_menus' => DynamicMenu::where('level', 2)->get(),
            'tertiary_menus' => DynamicMenu::where('level', 3)->get(),
        ];
        return view('dynamic_menu.create', $data);
    }

    public function store(Request $request)
    {
        try {
            $dynamic_menu = new DynamicMenu();
            $dynamic_menu->nama = $request->nama;
            $dynamic_menu->slug = Str::slug($request->nama);

            // pengcodean level menu
            if ($request->level == 1) {
                // incremental level 1
                // get last id
                $last_id = DynamicMenu::where('level', 1)->latest()->count();
                $code = ($last_id + 1);
            } else if ($request->level == 2) {
                // incremental level 2
                $primary_menu = DynamicMenu::find($request->primary_menu_id);
                $last_id = DynamicMenu::where('level', 2)->latest()->count();
                $code = $primary_menu->code .'.'. ($last_id + 1);
            } else if ($request->level == 3) {
                // incremental level 3
                $secondary_menu = DynamicMenu::find($request->secondary_menu_id);
                $last_id = DynamicMenu::where('code', 'LIKE', $secondary_menu->code . '%')->count();
                $code = $secondary_menu->code . '.'. ($last_id);
            }
            $dynamic_menu->level = $request->level;
            $dynamic_menu->code = $code;

            // cek tipe menu
            if ($request->tipe_menu == 'page') {
                $dynamic_menu->page_id = $request->page_id;
                $dynamic_menu->link = NULL;
            } else {
                $dynamic_menu->page_id = NULL;
                $dynamic_menu->link = $request->link;
            }

            $dynamic_menu->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat menu: ' . $e->getMessage());
        }

        return redirect()->route('dashboard.dynamic_menu.index')->with('success', 'menu berhasi disimpan.');
    }

    public function edit($id)
    {
        $dynamic_menu = DynamicMenu::findOrFail($id);
        return view('dynamic_menu.edit', [
            'data' => $dynamic_menu,
            'title' => 'Edit Menu',
            'primary_menus' => DynamicMenu::where('level', 1)->get(),
            'secondary_menus' => DynamicMenu::where('level', 2)->get(),
            'tertiary_menus' => DynamicMenu::where('level', 3)->get(),
            'pages' => Page::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $dynamic_menu = DynamicMenu::findOrFail($id);

        try {
            $dynamic_menu->nama = $request->nama;
            $dynamic_menu->slug = Str::slug($request->nama);

            $dynamic_menu->level = $request->level;
            $dynamic_menu->code = $request->code;

            // cek tipe menu
            if ($request->tipe_menu == 'page') {
                $dynamic_menu->page_id = $request->page_id;
                $dynamic_menu->link = NULL;
            } else {
                $dynamic_menu->page_id = NULL;
                $dynamic_menu->link = $request->link;
            }

            $dynamic_menu->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengubah data menu.');
    }

    public function destroy(Request $request, $id)
    {
        $dynamic_menu = DynamicMenu::findOrFail($id);

        try {
            $dynamic_menu->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil menghapus menu.');
    }
}
