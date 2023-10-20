<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lb3Kytd extends Model
{
    use HasFactory;
    protected $table = 'lb3_kytd';
    protected $fillable = [
      'tanggal',
      'puskesmas_id',
      'unmet_need',
      'kehamilan_diluar_nikah',
      'kegagalan_kb',
    ];


   public function puskesmas()
   {
     return $this->belongsTo(Puskesmas::class, 'puskesmas_id');
   }
}
