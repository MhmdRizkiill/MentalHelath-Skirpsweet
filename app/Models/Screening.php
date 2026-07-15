<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Screening extends Model
{
    use HasFactory;

    protected $table = 'screenings';

    // Sesuaikan fillable
    protected $fillable = [
        'user_id',
        'total_score', // Biarkan saja untuk kompatibilitas data lama
        'status',      // Biarkan saja untuk kompatibilitas data lama
        'answers',
        'score_depresi', 'status_depresi',
        'score_kecemasan', 'status_kecemasan',
        'score_stres', 'status_stres',
    ];

    // Tambahkan blok casts ini agar Laravel otomatis mengubah JSON menjadi Array saat dipanggil
    protected $casts = [
        'answers' => 'array',
        'total_score' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}