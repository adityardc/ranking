<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function divisi()
    {
        return $this->belongsTo('App\Divisi')->withTrashed();
    }

    public function ptpn()
    {
        return $this->belongsTo('App\Ptpn')->withTrashed();
    }

    public function golongan()
    {
        return $this->belongsTo('App\Golongan')->withTrashed();
    }

    public function mkg()
    {
        return $this->belongsTo('App\Mkg')->withTrashed();
    }

    public function jabatan()
    {
        return $this->belongsTo('App\Jabatan')->withTrashed();
    }

    public function distribusi_karyawan()
    {
        return $this->hasMany('App\DistribusiKaryawan', 'user_id');
    }

    public function setNameAttribute($value)
    {
    	$this->attributes['name'] = strtoupper($value);
    }
}
