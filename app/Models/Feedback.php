<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'bap_id',
        'id_mahasiswa',
        'nama_mahasiswa',
        'nim',
        'kelas',
        'feedback',
    ];

    /**
     * Relasi dengan model Bap
     */
    public function bap()
    {
        return $this->belongsTo(Bap::class);
    }
}
