<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lbtt extends Model
{
    protected $table = 'lbtt';
    protected $fillable = [
      'tanggal',
      'puskesmas_id',
      'dokter_terlatih_usg',
      'kader_terlatih_ptkb',
      'nakes_terlatih_mbts',
      'nakes_terlatih_tlgb',
      'nakes_terlatih_pmba',
      'nakes_terlatih_sdidtk',
      'nakes_terlatih_imtbsgb',
      'nakes_terlatih_pmba_sdidtk'
    ];


   public function puskesmas()
   {
     return $this->belongsTo(Puskesmas::class, 'puskesmas_id');
   }
}
