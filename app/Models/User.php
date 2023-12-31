<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use App\Traits\HasPermissionsTrait;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use DateTimeInterface;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasPermissionsTrait, canResetPassword;

    protected $fillable = [
      'name',
      'email',
      'username',
      'image',
      'active',
      'password',
      'jabatan_id',
      'nik',
      'last_seen',
      'puskesmas_id',
    ];

    protected $hidden = [
      'password',
      'remember_token',
    ];

    protected $casts = [
      'email_verified_at' => 'datetime',
    ];


    public function puskesmas()
    {
      return $this->belongsTo(Puskesmas::class, 'puskesmas_id');
    }


    public function sendPasswordResetNotification($token)
    {
      $this->notify(new ResetPasswordNotification($token));
    }

    protected function serializeDate(DateTimeInterface $date)
    {
      return $date->format('Y-m-d');
    }


}
