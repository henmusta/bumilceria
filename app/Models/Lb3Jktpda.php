<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lb3Jktpda extends Model
{
    use HasFactory;
    protected $table = 'lb3_jktpda';
    protected $fillable = [
      'tanggal',
      'puskesmas_id',
      'keterangan'
    ];


   public function puskesmas()
   {
     return $this->belongsTo(Puskesmas::class, 'puskesmas_id');
   }

   public function jktpdadetail()
   {
       return $this->hasMany(Lb3JktpdaDetail::class);
   }
}
