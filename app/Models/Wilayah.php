<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    use HasFactory;

    protected $table = 'wilayah';
    protected $fillable = [
      'provinsi_id',
      'kabupaten_id',
      'kecamatan_id',
      'alamat',
    ];

    public function provinsi()
    {
      return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }

    public function kabupaten()
    {
      return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }

    public function kecamatan()
    {
      return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }
}
