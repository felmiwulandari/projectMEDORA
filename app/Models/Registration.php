<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'patient_id',
        'specialist_id',
        'schedule_id',
        'jam_mulai',
        'jam_selesai',
        'tanggal_daftar',
        'status',
        'keluhan',
    ];

    
    // Relasi ke Patient
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    // Relasi ke Doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
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
            'diterima' => '🟢 Diterima',
            'ditutup' => '🔴 Ditolak',
            default => $this->status
        };

    }
}
