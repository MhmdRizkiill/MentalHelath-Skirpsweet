<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    /**
     * Menentukan nama tabel (opsional jika mengikuti konvensi Laravel, namun baik untuk ketegasan)
     */
    protected $table = 'questions';

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignment)
     */
    protected $fillable = ['code', 'question_text', 'category'
    ];

    /**
     * Accessor untuk mendapatkan nama kategori dengan huruf kapital di awal (Capitalize)
     * Contoh: 'depression' menjadi 'Depression'
     */
    public function getCategoryFormattedAttribute(): string
    {
        return ucfirst($this->category);
    }
}