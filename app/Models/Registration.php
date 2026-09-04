<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'schedule_id',
        'tanggal_daftar',
        'status',
        'keluhan',
    ];

    
    // Relasi ke Patient
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    // Relasi ke Schedule
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }

    // Accessor status label
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'menunggu' => '🟡 Menunggu',
            'diterima' => '🟢 Di Konfirmasi',
            'ditutup' => '🔴 Di Tolak',
            default => $this->status
        };

    }
}
