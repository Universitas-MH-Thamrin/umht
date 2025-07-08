<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::query()
            ->orderByDesc('created_at')
            ->get();

        return view('testimonial', [
            'testimonials' => $testimonials,
            'title' => 'Kata Alumni',
        ]);
    }
}
