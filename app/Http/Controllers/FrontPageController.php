<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Faq;
use App\Models\Kontak;
use App\Models\LinkTerkait;
use App\Models\Page;
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
}
