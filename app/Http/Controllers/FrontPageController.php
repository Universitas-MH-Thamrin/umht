<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Carousel;
use App\Models\Cta;
use App\Models\Faq;
use App\Models\Folder;
use App\Models\Galeri;
use App\Models\HeroBanner;
use App\Models\Kontak;
use App\Models\Layanan;
use App\Models\LinkTerkait;
use App\Models\Page;
use App\Models\Slider;
use App\Models\Video;
use Illuminate\Http\Request;

class FrontPageController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('visible', 1)->orderBy('id', 'DESC')->get();
        $carousels = Carousel::where('visible', 1)->orderBy('id', 'DESC')->get();
        $beritas = Berita::where('visible', 1)->orderBy('id', 'DESC')->take(3)->get();
        $layanans = Layanan::where('visible', 1)->orderBy('urutan', 'ASC')->get();
        $cta = Cta::where('visible', 1)->first();
        $hero_banner = HeroBanner::where('visible', 1)->first();
        $data = [
            'title' => env('APP_NAME'),
            'sliders' => $sliders,
            'carousels' => $carousels,
            'beritas' => $beritas,
            'layanans' => $layanans,
            'cta' => $cta,
            'hero_banner' => $hero_banner,
        ];
        return view('welcome', $data);
    }

    public function berita()
    {
        $beritas = Berita::where('visible', 1)->orderBy('id', 'DESC')->paginate(3);
        $link_terkaits = LinkTerkait::where('visible', 1)->orderBy('id', 'DESC')->get();
        $data = [
            'title' => 'Berita ' . env('APP_NAME'),
            'beritas' => $beritas,
            'link_terkaits' => $link_terkaits,
        ];
        return view('berita', $data);
    }

    public function berita_detail($slug)
    {
        $berita = Berita::where('slug', $slug)->first();
        $link_terkaits = LinkTerkait::where('visible', 1)->orderBy('id', 'DESC')->get();
        $berita->save();

        $beritas = Berita::where('visible', 1)->orderBy('id', 'DESC')->take(5)->get();
        $data = [
            'title' => $berita->judul,
            'beritas' => $beritas,
            'data' => $berita,
            'link_terkaits' => $link_terkaits,
        ];

        return view('berita_detail', $data);
    }

    public function page_show(Request $request, $slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        $data = [
            'title' => $page->nama,
            'data' => $page
        ];

        return view('page_detail', $data);
    }

    public function kontak(Request $request)
    {
        if (request()->method() == 'POST') {
            $this->validate($request, [
                'name' => 'required'
            ]);

            $kontak = new Kontak();
            $kontak->name = $request->name;
            $kontak->email = $request->email;
            $kontak->subject = $request->subject;
            $kontak->message = $request->message;
            $kontak->save();
            return redirect()->back()->with('success', 'Pesan berhasil dikirim.');
        }

        $link_terkaits = LinkTerkait::where('visible', 1)->orderBy('id', 'DESC')->get();
        $data = [
            'title' => 'Kontak Kami',
            'link_terkaits' => $link_terkaits,
        ];
        return view('kontak', $data);
    }

    public function faq()
    {
        $faqs = Faq::where('visible', 1)->orderBy('id', 'DESC')->get();
        $link_terkaits = LinkTerkait::where('visible', 1)->orderBy('id', 'DESC')->get();
        $data = [
            'title' => 'Data Faq',
            'faqs' => $faqs,
            'link_terkaits' => $link_terkaits,
        ];
        return view('faq', $data);
    }

    public function foto()
    {
        $fotos = Galeri::orderBy('id', 'DESC')->paginate(6);
        $link_terkaits = LinkTerkait::where('visible', 1)->orderBy('id', 'DESC')->get();
        $data = [
            'title' => 'Galeri ' . env('APP_NAME'),
            'fotos' => $fotos,
            'folders' => Folder::all(),
            'link_terkaits' => $link_terkaits,
        ];
        return view('foto', $data);
    }

    public function foto_folder($folder_id)
    {
        $fotos = Galeri::where('folder_id', $folder_id)->orderBy('id', 'DESC')->paginate(6);
        $link_terkaits = LinkTerkait::where('visible', 1)->orderBy('id', 'DESC')->get();
        $data = [
            'title' => 'Galeri Folder ' . env('APP_NAME'),
            'fotos' => $fotos,
            'folders' => Folder::all(),
            'link_terkaits' => $link_terkaits,
        ];
        return view('foto', $data);
    }

    public function video()
    {
        $videos = Video::orderBy('id', 'DESC')->paginate(6);
        $link_terkaits = LinkTerkait::where('visible', 1)->orderBy('id', 'DESC')->get();
        $data = [
            'title' => 'Galeri Video ' . env('APP_NAME'),
            'videos' => $videos,
            'folders' => Folder::all(),
            'link_terkaits' => $link_terkaits,
        ];
        return view('video', $data);
    }

    public function video_folder($folder_id)
    {
        $videos = Video::where('folder_id', $folder_id)->orderBy('id', 'DESC')->paginate(6);
        $link_terkaits = LinkTerkait::where('visible', 1)->orderBy('id', 'DESC')->get();
        $data = [
            'title' => 'Galeri Video Folder ' . env('APP_NAME'),
            'videos' => $videos,
            'folders' => Folder::all(),
            'link_terkaits' => $link_terkaits,
        ];
        return view('video', $data);
    }
}
