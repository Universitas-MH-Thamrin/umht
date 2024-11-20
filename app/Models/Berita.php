<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Author'
        ]);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class)->withDefault([
            'nama' => 'Tidak Berkategori'
        ]);
    }
}
