<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use SoftDeletes;

    public function setNamaKategoriAttribute($value)
    {
    	$this->attributes['nama_kategori'] = strtoupper($value);
    }
}
