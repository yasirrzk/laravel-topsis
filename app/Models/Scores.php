<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scores extends Model
{
    use HasFactory;

    protected $fillable = [
        'alternative_id',
        'subkriteria_id',
        'value'
    ];

    public function alternative()
    {
        return $this->belongsTo(Alternatif::class, 'alternative_id');
    }

    public function subkriteria()
    {
        return $this->belongsTo(SubKriteria::class, 'subkriteria_id');
    }
}
