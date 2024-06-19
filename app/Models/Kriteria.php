<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_kriteria',
        'nama',
        'weight',
        'type'
      ];
    
      public function subKriterias()
      {
          return $this->hasMany(SubKriteria::class);
      }
}
