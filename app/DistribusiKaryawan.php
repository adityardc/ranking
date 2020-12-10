<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistribusiKaryawan extends Model
{
    protected $fillable = [
        'nama', 'nik', 'divisi_id', 'sub_bagian', 'gol_awal', 'mkg_awal', 'usul_approve', 'final_approve', 'ptpn_id'
    ];

    public function setNamaAttribute($value)
    {
    	$this->attributes['nama'] = strtoupper($value);
    }

    public function setSubBagianAttribute($value)
    {
    	$this->attributes['sub_bagian'] = strtoupper($value);
    }

    public function golongan()
    {
        return $this->belongsTo('App\Golongan')->withTrashed();
    }

    public function divisi()
    {
        return $this->belongsTo('App\Divisi')->withTrashed();
    }

    public function ptpn()
    {
        return $this->belongsTo('App\Ptpn')->withTrashed();
    }

    public function mkg()
    {
        return $this->belongsTo('App\Mkg')->withTrashed();
    }

    public function indikator()
    {
        return $this->belongsTo('App\Indikator');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
