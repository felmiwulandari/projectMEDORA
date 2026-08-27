<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table = "doctors";
    protected $fillable = [
        "name",
        "spesialist_id",
        "status",
        "no_hp",
    ];

    public function guests()
    {
        return $this->hasMany(Specialist::class, "specialist_id");
    }
}
