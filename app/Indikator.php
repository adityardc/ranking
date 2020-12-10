<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{    
    public function penilaians()
    {
        return $this->hasMany('App\PenilaianIndikator');
    }

    public function ptpn()
    {
        return $this->belongsTo('App\Ptpn')->withTrashed();
    }

    public function divisi()
    {
        return $this->belongsTo('App\Divisi')->withTrashed();
    }

    public function getKategoriHtmlAttribute()
    {
        $baris       = array();
        $arrKategori = explode(',', $this->kategori_id);
        $arrKategori = array_map('floatval', $arrKategori);
        $tujuan      = Kategori::whereIn('id', $arrKategori)->get();

        foreach($tujuan as $bag => $x) {
            // $baris[] = "<span class='label label-success'><strong>".$x->nama_kategori."</strong></span>";
            $baris[] = "<button type='button' class='btn btn-primary btn-xs waves-effect waves-light'>".$x->nama_kategori."</button>";
        }

        return implode("  ", $baris);
    }
}
