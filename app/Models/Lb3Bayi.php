<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lb3Bayi extends Model
{
    use HasFactory;
    protected $table = 'lb3_bayi';
    protected $fillable = [
      'tahun',
      'puskesmas_id',
      'sasaran_bayi_laki_laki',
      'sasaran_bayi_perempuan',
      'bayi_lahir_laki_laki',
      'bayi_lahir_perempuan',
      'kn1_laki_laki',
      'kn1_perempuan',
      'kn3_laki_laki',
      'kn3_perempuan',
      'bbl_lld_shk',
      'bbl_pd_shk',
      'created_at',
      'updated_at'
    ];


   public function puskesmas()
   {
     return $this->belongsTo(Puskesmas::class, 'puskesmas_id');
   }
}
