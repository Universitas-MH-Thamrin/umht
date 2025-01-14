<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accreditation extends Model
{
    use HasFactory;

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->created_at)->translatedFormat('d F Y');
    }

    protected $fillable = [
        'name',
        'document',
        'expirated',
    ];
}
