<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kpi extends Model
{
    use SoftDeletes;

    public function setNamaKpiAttribute($value)
    {
    	$this->attributes['nama_kpi'] = strtoupper($value);
    }

    public function kategori()
    {
        return $this->belongsTo('App\Kategori')->withTrashed();
    }

    public function satuan()
    {
        return $this->belongsTo('App\Satuan')->withTrashed();
    }
}
