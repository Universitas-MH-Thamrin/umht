<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Page;
use App\Models\Slider;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_berita = Berita::count();
        $total_halaman = Page::count();
        $total_slider = Slider::count();
        $berita_terbaru = Berita::orderBy('id', 'DESC')->take(5)->get();

        $data = [
            'title' => 'Dashboard',
            'total_berita' => $total_berita,
            'total_halaman' => $total_halaman,
            'total_slider' => $total_slider,
            'berita_terbaru' => $berita_terbaru,
        ];

        return view('dashboard', $data);
    }
}
