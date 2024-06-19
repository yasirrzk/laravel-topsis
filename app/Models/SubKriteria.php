<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'kriteria_id',
        'name',
        'weight',
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }

    public function values()
    {
        return $this->hasMany(Value::class, 'sub_kriteria_id');
    }
}
