<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Divisi extends Model
{
    use SoftDeletes;

    public function setKodeDivisiAttribute($value)
    {
    	$this->attributes['kode_divisi'] = strtoupper($value);
    }

    public function setNamaDivisiAttribute($value)
    {
    	$this->attributes['nama_divisi'] = strtoupper($value);
    }

    public function ptpn()
    {
        return $this->belongsTo('App\Ptpn')->withTrashed();
    }

    public function kategoridivisis()
    {
        return $this->hasMany('App\KategoriDivisi');
    }
}
