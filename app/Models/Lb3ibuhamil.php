<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lb3ibuhamil extends Model
{
    use HasFactory;

    protected $table = 'lb3_ibu_hamil';
    protected $fillable = [
      'tahun',
      'puskesmas_id',
      'jsih',
      'k1_total',
      'k1_murni',
      'k4',
      'k6',
      'ihttm',
      'ibdjtd',
      'ihdktb',
      'k1_ok',
      'k5_ok',
      'k1_usg_ok',
      'k5_usg_ok',
      'ibmb_kia',
    ];


   public function puskesmas()
   {
     return $this->belongsTo(Puskesmas::class, 'puskesmas_id');
   }
}
