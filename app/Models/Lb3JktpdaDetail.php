<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lb3JktpdaDetail extends Model
{
    use HasFactory;
    protected $table = 'lb3_jktpda_detail';
    protected $fillable = [
      'tanggal',
      'puskesmas_id',
      'name',
      'lb3_jktpda_id',
      '0_sampai_15',
      '16_sampai_45',
      '46_sampai_60',
      '60_keatas',
    ];


   public function jktpda()
   {
     return $this->belongsTo(Lb3Jktpda::class, 'lb3_jktpda_id');
   }
}
