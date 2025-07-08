<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bap extends Model
{
    use HasFactory;

    protected $fillable = [
        'jadwal_id',
        'tanggal',
        'materi',
        'keterangan',
        'approved_by',
        'approved_at',
        'status',
        'created_by', // Tambahkan kolom created_by
    ];

    // Relasi ke Jadwal
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    // Relasi ke User (pembuat BAP)
    // Relasi ke User (pembuat BAP)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    // Relasi ke Feedback
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'bap_id');
    }
}