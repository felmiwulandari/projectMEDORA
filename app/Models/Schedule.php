<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'kuota',
        'status',
    ];

     public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
