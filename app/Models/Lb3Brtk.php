<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lb3Brtk extends Model
{
    protected $table = 'lb3_brtk';
    protected $fillable = [
      'tahun',
      'puskesmas_id',
      'bblr',
      'asfiksia',
      'infeksi',
      'tetanus',
      'kelainan',
      'covid19',
      'hipotiroid',
      'lain_lain'
    ];


   public function puskesmas()
   {
     return $this->belongsTo(Puskesmas::class, 'puskesmas_id');
   }
}
