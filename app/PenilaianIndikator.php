<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenilaianIndikator extends Model
{    
    public function setNamaIndikatorAttribute($value)
    {
    	$this->attributes['nama_indikator'] = strtoupper($value);
    }

    public function kpi()
    {
        return $this->belongsTo('App\Kpi')->withTrashed();
    }

    public function getFormatKurlebAttribute()
    {
        $asd = $this->kurleb;
        return ($asd < 0 ? "(".number_format(abs($asd), 2, ",", ".").")" : number_format($asd, 2, ",", "."));
    }

    public function getFormatRkappAttribute()
    {
        $rkapp = $this->rkapp;
        return ($rkapp < 0 ? "(".number_format(abs($rkapp), 2, ",", ".").")" : number_format($rkapp, 2, ",", "."));
    }

    public function getFormatRealisasiAttribute()
    {
        $real = $this->realisasi;
        return ($real < 0 ? "(".number_format(abs($real), 2, ",", ".").")" : number_format($real, 2, ",", "."));
    }

    public function getFormatRealKpiAttribute()
    {
        $kpi   = $this->real_kpi;
        return ($kpi < 0 ? "(".abs($kpi).")" : $kpi);
    }
}
