<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lki extends Model
{
    protected $table = 'lki';
    protected $fillable = [
      'tanggal',
      'puskesmas_id',
      'jpkih',
      'jpkib',

    ];


   public function puskesmas()
   {
     return $this->belongsTo(Puskesmas::class, 'puskesmas_id');
   }
}
