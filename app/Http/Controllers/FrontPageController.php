<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontPageController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('visible', 1)->orderBy('id', 'DESC')->get();
        $beritas = Berita::where('visible', 1)->orderBy('id', 'DESC')->take(3)->get();
        $data = [
            'title' => env('APP_NAME'),
            'sliders' => $sliders,
            'beritas' => $beritas,
        ];
        return view('welcome', $data);
    }
}
