<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mkg extends Model
{
    use SoftDeletes;

    public function golongan()
    {
        return $this->belongsTo('App\Golongan')->withTrashed();
    }
}
