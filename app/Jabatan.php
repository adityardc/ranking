<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jabatan extends Model
{
    use SoftDeletes;

    public function setNamaJabatanAttribute($value)
    {
    	$this->attributes['nama_jabatan'] = strtoupper($value);
    }
}
