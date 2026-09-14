<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Import trait SoftDeletes

class Book extends Model
{
    use HasFactory, SoftDeletes; // Gunakan trait SoftDeletes

    protected $table = 'books';

    // Kolom yang diizinkan untuk pengisian massal (mass assignment)
    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'stok',
    ];
}
