<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lb3Balita extends Model
{
    use HasFactory;
    protected $table = 'lb3_balita';
    protected $fillable = [
      'tanggal',
      'puskesmas_id',
      'sasaran_balita_laki_laki',
      'sasaran_balita_perempuan',
      'bllmb_kia',
       'bpmb_kia',
       'blldtk',
       'bpdtk',
       'blldgp',
       'bpdgp',
       'sdidtk_bll',
       'sdidtk_bp',
       'kbs_ll',
       'kbs_p',
       'mtbs_ll',
       'mtbs_p',
    ];


   public function puskesmas()
   {
     return $this->belongsTo(Puskesmas::class, 'puskesmas_id');
   }
}
