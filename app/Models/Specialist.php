<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    use HasFactory;
    protected $table = "specialists";
    protected $fillable = [
        "name",
        "status"
    ];

     public function doctors()
    {
        return $this->hasMany(Doctor::class, "specialist_id");
    }
}
