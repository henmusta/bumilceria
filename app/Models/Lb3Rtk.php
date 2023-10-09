<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lb3Rtk extends Model
{
    protected $table = 'lb3_rtk';
    protected $fillable = [
      'tahun',
      'puskesmas_id',
      'anemia_trimester1',
      'anemia_trimester3',
      'pendarahan',
      'pre_eklamsia',
      'infeksi',
      'tuberculosis',
      'malaria',
      'jantung',
      'diabetes_mellitus',
      'obesitas',
      'covid19',
      'abortus',
      'lain_lain'
    ];


   public function puskesmas()
   {
     return $this->belongsTo(Puskesmas::class, 'puskesmas_id');
   }
}
