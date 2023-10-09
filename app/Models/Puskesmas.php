<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puskesmas extends Model
{
    use HasFactory;

    protected $table = 'puskesmas';
    protected $fillable = [
      'wilayah_id',
      'name',
      'keterangan',
    ];

    public function wilayah()
    {
      return $this->belongsTo(Wilayah::class, 'wilayah_id');
    }

    public function lb3ibuhamil()
    {
        return $this->hasMany(lb3ibuhamil::class);
    }

    public function lb3ibubersalin()
    {
        return $this->hasMany(lb3ibubersalin::class);
    }

    public function lb3rtk()
    {
        return $this->hasMany(lb3Rtk::class);
    }

    public function lb3bayi()
    {
        return $this->hasMany(lb3Bayi::class);
    }


    public function lb3brtk()
    {
        return $this->hasMany(lb3Brtk::class);
    }

    public function lb3balita()
    {
        return $this->hasMany(lb3Balita::class);
    }

    public function lki()
    {
        return $this->hasMany(lki::class);
    }

    public function lbtt()
    {
        return $this->hasMany(lbtt::class);
    }

    public function users()
    {
      return $this->belongsToMany(User::class);
    }

}
