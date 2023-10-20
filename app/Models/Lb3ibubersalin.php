<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lb3ibubersalin extends Model
{
    use HasFactory;

    protected $table = 'lb3_ibu_bersalin';
    protected $fillable = [
      'tanggal',
      'puskesmas_id',
      'jsib',
      'ibu_bersalin',
      'ibu_bersalin_nakes',
      'ibu_bersalin_faskes',
      'kf1',
      'kf_lengkap',
      'vita_ibu_nifas',

    ];


   public function puskesmas()
   {
     return $this->belongsTo(Puskesmas::class, 'puskesmas_id');
   }
}
