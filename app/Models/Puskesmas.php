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
        return $this->hasMany(Lb3ibuhamil::class);
    }

    public function lb3ibubersalin()
    {
        return $this->hasMany(Lb3ibubersalin::class);
    }

    public function lb3rtk()
    {
        return $this->hasMany(Lb3Rtk::class);
    }

    public function lb3bayi()
    {
        return $this->hasMany(Lb3Bayi::class);
    }


    public function lb3brtk()
    {
        return $this->hasMany(Lb3Brtk::class);
    }

    public function lb3balita()
    {
        return $this->hasMany(Lb3Balita::class);
    }

    public function lki()
    {
        return $this->hasMany(Lki::class);
    }

    public function lbtt()
    {
        return $this->hasMany(Lbtt::class);
    }

    public function lb3jktpda()
    {
        return $this->hasMany(Lb3Jktpda::class);
    }
    public function lb3jktpdadetail()
    {
        return $this->hasMany(Lb3JktpdaDetail::class);
    }

    public function lb3kytd()
    {
        return $this->hasMany(Lb3Kytd::class);
    }

    public function users()
    {
      return $this->belongsToMany(User::class);
    }

}
