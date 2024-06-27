<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'code_alternatif',
        'nama',
        'alamat'
    ];

    public function scores(){
        return $this->hasMany(scores::class, 'alternative_id');
    }
}
